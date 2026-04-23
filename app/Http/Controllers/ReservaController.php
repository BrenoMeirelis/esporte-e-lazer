<?php

namespace App\Http\Controllers;

use App\Models\Reserva;
use Illuminate\Http\Request;
use App\Models\Espaco;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class ReservaController extends Controller
{
    use AuthorizesRequests;

    // 🔥 EVENTOS DO CALENDÁRIO
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

    // 🔥 TELA DO CALENDÁRIO
    public function calendario()
    {
        return view('reservas.calendario');
    }

    // 🔥 LISTAGEM
    public function index()
    {
        $this->authorize('index', Reserva::class);

        $user = auth()->user();

        if ($user->tipo == 'admin') {
            $reservas = Reserva::with('espaco', 'user')->get();
        } else {
            $reservas = Reserva::with('espaco', 'user')
                ->where('user_id', $user->id)
                ->get();
        }

        return view('reservas.index', compact('reservas'));
    }

    // 🔥 FORM DE RESERVA (CORRIGIDO AQUI)
    public function create($espaco_id)
    {
        $this->authorize('create', Reserva::class);

        $espaco = Espaco::findOrFail($espaco_id);

        return view('reservas.create', compact('espaco'));
    }

    public function store(Request $request)
    {
        $this->authorize('create', Reserva::class);

        $request->validate([
            'espaco_id' => 'required|exists:espacos,id',
            'data' => 'required|date',
            'hora_inicio' => 'required',
            'hora_fim' => 'required|after:hora_inicio'
        ]);

        $existe = Reserva::where('espaco_id', $request->espaco_id)
            ->where('data', $request->data)
            ->where(function ($q) use ($request) {
                $q->whereBetween('hora_inicio', [$request->hora_inicio, $request->hora_fim])
                    ->orWhereBetween('hora_fim', [$request->hora_inicio, $request->hora_fim])
                    ->orWhere(function ($q2) use ($request) {
                        $q2->where('hora_inicio', '<=', $request->hora_inicio)
                            ->where('hora_fim', '>=', $request->hora_fim);
                    });
            })->exists();

        if ($existe) {
            return back()->with('error', 'Este horário já está reservado!');
        }

        Reserva::create([
            'espaco_id' => $request->espaco_id,
            'user_id' => auth()->id(),
            'data' => $request->data,
            'hora_inicio' => $request->hora_inicio,
            'hora_fim' => $request->hora_fim
        ]);

        return redirect()->route('reservas.index')
            ->with('success', 'Reserva criada com sucesso!');
    }

    // 🔥 MOSTRAR
    public function show(Reserva $reserva)
    {
        $this->authorize('show', $reserva);

        return view('reservas.show', compact('reserva'));
    }

    // 🔥 EDITAR
    public function edit(Reserva $reserva)
    {
        $this->authorize('update', $reserva);

        $espacos = Espaco::all();

        return view('reservas.edit', compact('reserva', 'espacos'));
    }

    // 🔥 ATUALIZAR
    public function update(Request $request, Reserva $reserva)
    {
        $this->authorize('update', $reserva);

        $request->validate([
            'espaco_id' => 'required|exists:espacos,id',
            'data' => 'required|date',
            'hora_inicio' => 'required',
            'hora_fim' => 'required|after:hora_inicio'
        ]);

        $existeReserva = Reserva::where('espaco_id', $request->espaco_id)
            ->where('data', $request->data)
            ->where('id', '!=', $reserva->id)
            ->where(function ($query) use ($request) {

                $query->whereBetween('hora_inicio', [$request->hora_inicio, $request->hora_fim])
                    ->orWhereBetween('hora_fim', [$request->hora_inicio, $request->hora_fim])
                    ->orWhere(function ($q) use ($request) {
                        $q->where('hora_inicio', '<=', $request->hora_inicio)
                            ->where('hora_fim', '>=', $request->hora_fim);
                    });
            })->exists();

        if ($existeReserva) {
            return back()->with('erro', 'Este horário já está reservado!');
        }

        $reserva->update($request->only([
            'espaco_id',
            'data',
            'hora_inicio',
            'hora_fim'
        ]));

        return redirect()->route('reservas.index')
            ->with('sucesso', 'Reserva atualizada com sucesso!');
    }

    // 🔥 DELETAR
    public function destroy(Reserva $reserva)
    {
        $this->authorize('delete', $reserva);

        $reserva->delete();

        return redirect()->route('reservas.index')
            ->with('sucesso', 'Reserva excluída com sucesso!');
    }
}
