<?php

namespace App\Http\Controllers;

use App\Models\Reserva;
use Illuminate\Http\Request;
use App\Models\Espaco;

class ReservaController extends Controller
{

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
        $reservas = Reserva::with('espaco','user')->get();

        return view('reservas.index', compact('reservas'));
    }


    public function create(Request $request)
    {
        $espacos = Espaco::all();
        $data = $request->data;

        return view('reservas.create', compact('espacos','data'));
    }


    public function store(Request $request)
    {
        $existeReserva = Reserva::where('espaco_id', $request->espaco_id)
            ->where('data', $request->data)
            ->where(function($query) use ($request) {

                $query->whereBetween('hora_inicio', [$request->hora_inicio, $request->hora_fim])
                        ->orWhereBetween('hora_fim', [$request->hora_inicio, $request->hora_fim])
                        ->orWhere(function($q) use ($request) {
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
        //
    }


    public function edit(Reserva $reserva)
    {
        //
    }


    public function update(Request $request, Reserva $reserva)
    {
        //
    }


    public function destroy(Reserva $reserva)
    {
        //
    }


    private function corEspaco($id)
    {
        $cores = [
            1 => '#28a745',
            2 => '#007bff',
            3 => '#ffc107',
            4 => '#dc3545'
        ];

        return $cores[$id] ?? '#6c757d';
    }

}
