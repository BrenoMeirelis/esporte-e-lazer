<?php

namespace App\Http\Controllers;

use App\Models\Reserva;
use App\Models\Espaco;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class ReservaController extends Controller
{
    use AuthorizesRequests;

    /*
    |--------------------------------------------------------------------------
    | EVENTOS CALENDÁRIO
    |--------------------------------------------------------------------------
    */
    public function eventos()
    {
        $reservas = Reserva::selectRaw('data, COUNT(*) as total')
            ->groupBy('data')
            ->get();

        $eventos = [];

        foreach ($reservas as $reserva) {
            $eventos[] = [
                'title' => $reserva->total . ' reservas',
                'start' => $reserva->data,
                'color' => '#28a745'
            ];
        }

        return response()->json($eventos);
    }

    /*
    |--------------------------------------------------------------------------
    | CALENDÁRIO
    |--------------------------------------------------------------------------
    */
    public function calendario()
    {
        return view('reservas.calendario');
    }

    /*
    |--------------------------------------------------------------------------
    | LISTAGEM
    |--------------------------------------------------------------------------
    */
    public function index()
    {
        $this->authorize('index', Reserva::class);

        $user = auth()->user();

        // Super Admin vê tudo
        if ($user->tipo === 'super_admin') {

            $reservas = Reserva::with([
                'espaco.cidade',
                'user'
            ])
            ->latest()
            ->get();

        }
        // Admin de cidade
        elseif ($user->cidadesAdministradas()->exists()) {

            $cidadeIds = $user->cidadesAdministradas()
                ->pluck('cidades.id');

            $reservas = Reserva::with([
                'espaco.cidade',
                'user'
            ])
            ->whereHas('espaco', function ($query) use ($cidadeIds) {
                $query->whereIn('cidade_id', $cidadeIds);
            })
            ->latest()
            ->get();

        }
        // Usuário comum
        else {

            $reservas = Reserva::with([
                'espaco.cidade',
                'user'
            ])
            ->where('user_id', $user->id)
            ->latest()
            ->get();
        }

        return view('reservas.index', compact('reservas'));
    }

    /*
    |--------------------------------------------------------------------------
    | FORM NOVA RESERVA
    |--------------------------------------------------------------------------
    */
    public function create($espaco_id)
    {
        $this->authorize('create', Reserva::class);

        $espaco = Espaco::findOrFail($espaco_id);

        return view('reservas.create', compact('espaco'));
    }

    /*
    |--------------------------------------------------------------------------
    | SALVAR
    |--------------------------------------------------------------------------
    */
    public function store(Request $request)
    {
        $request->validate([
            'espaco_id'              => 'required|exists:espacos,id',
            'data'                   => 'required|date|after_or_equal:today',
            'hora_inicio'            => 'required',
            'hora_fim'               => 'required|after:hora_inicio',
            'numero_participantes'   => 'required|integer|min:1',
            'participantes'          => 'nullable|array',
            'participantes.*.nome'   => 'required|string|max:255',
            'participantes.*.documento' => 'required|string|max:20',
        ]);

        $espaco = Espaco::findOrFail($request->espaco_id);

        if ($request->hora_inicio < $espaco->horario_abertura) {
            return back()
                ->withInput()
                ->with('error', 'A reserva não pode começar antes do horário de abertura do espaço (' . $espaco->horario_abertura . ').');
        }

        if ($request->hora_fim > $espaco->horario_encerramento) {
            return back()
                ->withInput()
                ->with('error', 'A reserva não pode terminar depois do horário de encerramento do espaço (' . $espaco->horario_encerramento . ').');
        }

        if ($request->numero_participantes < $espaco->min_participantes) {
            return back()
                ->withInput()
                ->with('error', 'O número de participantes é menor que o mínimo permitido para este espaço (' . $espaco->min_participantes . ').');
        }

        if ($request->numero_participantes > $espaco->max_participantes) {
            return back()
                ->withInput()
                ->with('error', 'O número de participantes excede o máximo permitido para este espaço (' . $espaco->max_participantes . ').');
        }

        // Verifica conflito de horário com reservas existentes (ignora canceladas)
        $conflito = Reserva::where('espaco_id', $request->espaco_id)
            ->where('data', $request->data)
            ->where('status', '!=', 'cancelada')
            ->where(function ($query) use ($request) {
                $query->whereBetween('hora_inicio', [$request->hora_inicio, $request->hora_fim])
                    ->orWhereBetween('hora_fim', [$request->hora_inicio, $request->hora_fim])
                    ->orWhere(function ($q) use ($request) {
                        $q->where('hora_inicio', '<=', $request->hora_inicio)
                            ->where('hora_fim', '>=', $request->hora_fim);
                    });
            })
            ->exists();

        if ($conflito) {
            return back()
                ->withInput()
                ->with('error', 'Já existe uma reserva para este espaço neste horário. Por favor, escolha outro horário.');
        }

        Reserva::create([
            'espaco_id'            => $request->espaco_id,
            'user_id'              => auth()->id(),
            'data'                 => $request->data,
            'hora_inicio'          => $request->hora_inicio,
            'hora_fim'             => $request->hora_fim,
            'numero_participantes' => $request->numero_participantes,
            'participantes'        => $request->participantes,
            'status'               => 'pendente',
        ]);

        return redirect()
            ->route('reservas.index')
            ->with('success', 'Reserva realizada com sucesso!');
    }

    /*
    |--------------------------------------------------------------------------
    | DETALHES
    |--------------------------------------------------------------------------
    */
    public function show(Reserva $reserva)
    {
        $reserva->load([
            'espaco.cidade',
            'user'
        ]);

        return view('reservas.show', compact('reserva'));
    }

    /*
    |--------------------------------------------------------------------------
    | EDITAR
    |--------------------------------------------------------------------------
    */
    public function edit(Reserva $reserva)
    {
        $this->authorize('update', $reserva);

        $espacos = Espaco::all();

        return view('reservas.edit', compact('reserva', 'espacos'));
    }

    /*
    |--------------------------------------------------------------------------
    | ATUALIZAR
    |--------------------------------------------------------------------------
    */
    public function update(Request $request, Reserva $reserva)
    {
        $this->authorize('update', $reserva);

        $request->validate([
            'espaco_id'   => 'required|exists:espacos,id',
            'data'        => 'required|date',
            'hora_inicio' => 'required',
            'hora_fim'    => 'required|after:hora_inicio'
        ]);

        $existeReserva = Reserva::where('espaco_id', $request->espaco_id)
            ->where('data', $request->data)
            ->where('id', '!=', $reserva->id)
            ->where(function ($query) use ($request) {

                $query->whereBetween('hora_inicio', [
                    $request->hora_inicio,
                    $request->hora_fim
                ])
                ->orWhereBetween('hora_fim', [
                    $request->hora_inicio,
                    $request->hora_fim
                ])
                ->orWhere(function ($q) use ($request) {
                    $q->where('hora_inicio', '<=', $request->hora_inicio)
                        ->where('hora_fim', '>=', $request->hora_fim);
                });
            })
            ->exists();

        if ($existeReserva) {
            return back()->with('erro', 'Este horário já está reservado!');
        }

        $reserva->update($request->only([
            'espaco_id',
            'data',
            'hora_inicio',
            'hora_fim'
        ]));

        return redirect()
            ->route('reservas.index')
            ->with('sucesso', 'Reserva atualizada com sucesso!');
    }

    /*
    |--------------------------------------------------------------------------
    | EXCLUIR
    |--------------------------------------------------------------------------
    */
    public function destroy(Reserva $reserva)
    {
        $this->authorize('delete', $reserva);

        $reserva->delete();

        return redirect()
            ->route('reservas.index')
            ->with('sucesso', 'Reserva excluída com sucesso!');
    }

    /*
    |--------------------------------------------------------------------------
    | APROVAR
    |--------------------------------------------------------------------------
    */
    public function aprovar(Reserva $reserva)
    {
        $this->authorize('approve', $reserva);

        $reserva->update([
            'status' => 'aprovada'
        ]);

        return back()->with('success', 'Reserva aprovada com sucesso.');
    }

    /*
    |--------------------------------------------------------------------------
    | RECUSAR
    |--------------------------------------------------------------------------
    */
    public function rejeitar(Reserva $reserva)
    {
        $this->authorize('reject', $reserva);

        $reserva->update([
            'status' => 'recusada'
        ]);

        return back()->with('success', 'Reserva recusada com sucesso.');
    }
}
