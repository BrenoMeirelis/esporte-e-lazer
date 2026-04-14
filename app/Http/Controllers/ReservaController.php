<?php

namespace App\Http\Controllers;

use App\Models\Reserva;
use Illuminate\Http\Request;
use App\Models\Espaco;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class ReservaController extends Controller
{
    use AuthorizesRequests;

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

    public function calendario()
    {
        return view('reservas.calendario');
    }

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

    public function create(Request $request)
    {
        $this->authorize('create', Reserva::class);

        $espacos = Espaco::all();
        $data = $request->data;

        return view('reservas.create', compact('espacos', 'data'));
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

        $existeReserva = Reserva::where('espaco_id', $request->espaco_id)
            ->where('data', $request->data)
            ->where(function ($query) use ($request) {

                $query->whereBetween('hora_inicio', [$request->hora_inicio, $request->hora_fim])
                    ->orWhereBetween('hora_fim', [$request->hora_inicio, $request->hora_fim])
                    ->orWhere(function ($q) use ($request) {
                        $q->where('hora_inicio', '<=', $request->hora_inicio)
                            ->where('hora_fim', '>=', $request->hora_fim);
                    });

            })->exists();

        if ($existeReserva) {
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
            ->with('success', 'Reserva feita com sucesso!');
    }

    public function show(Reserva $reserva)
    {
        $this->authorize('show', $reserva);

        return view('reservas.show', compact('reserva'));
    }

    public function edit(Reserva $reserva)
    {
        $this->authorize('update', $reserva);

        $espacos = Espaco::all();

        return view('reservas.edit', compact('reserva', 'espacos'));
    }

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
            return back()->with('error', 'Este horário já está reservado!');
        }

        $reserva->update($request->only([
            'espaco_id', 'data', 'hora_inicio', 'hora_fim'
        ]));

        return redirect()->route('reservas.index')
            ->with('success', 'Reserva atualizada com sucesso!');
    }

    public function destroy(Reserva $reserva)
    {
        $this->authorize('delete', $reserva);

        $reserva->delete();

        return redirect()->route('reservas.index')
            ->with('success', 'Reserva excluída com sucesso!');
    }
}
