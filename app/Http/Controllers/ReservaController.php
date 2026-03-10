<?php

namespace App\Http\Controllers;

use App\Models\Reserva;
use Illuminate\Http\Request;
use App\Models\Espaco;

class ReservaController extends Controller
{

    public function eventos()
    {
        $reservas = Reserva::with(['espaco','user'])->get();

        $eventos = [];

        foreach ($reservas as $reserva) {

            $eventos[] = [

                'title' => $reserva->espaco->titulo . ' - ' . $reserva->user->name,

                'start' => $reserva->data.'T'.$reserva->hora_inicio,

                'end' => $reserva->data.'T'.$reserva->hora_fim,

                'color' => $this->corEspaco($reserva->espaco_id),

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
        //
    }


    public function create(Request $request)
    {
        $espacos = Espaco::all();

        $data = $request->data;

        return view('reservas.create', compact('espacos','data'));
    }


    public function store(Request $request)
{
    $request->validate([
        'espaco_id' => 'required',
        'data' => 'required|date',
        'hora_inicio' => 'required',
        'hora_fim' => 'required|after:hora_inicio'
    ]);

    // Verificar conflito de horário
    $conflito = \App\Models\Reserva::where('espaco_id', $request->espaco_id)
        ->where('data', $request->data)
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
        return back()->with('erro', 'Este horário já está reservado para este espaço.');
    }

    \App\Models\Reserva::create([
        'user_id' => auth()->id(),
        'espaco_id' => $request->espaco_id,
        'data' => $request->data,
        'hora_inicio' => $request->hora_inicio,
        'hora_fim' => $request->hora_fim
    ]);

    return redirect('/calendario')->with('sucesso','Reserva criada com sucesso');
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
