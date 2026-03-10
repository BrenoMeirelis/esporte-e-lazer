<?php

namespace App\Http\Controllers;

use App\Models\Reserva;
use Illuminate\Http\Request;

class ReservaController extends Controller
{

    public function eventos()
    {
        $reservas = Reserva::with('espaco')->get();

        $eventos = [];

        foreach ($reservas as $reserva) {

            $eventos[] = [

                'title' => $reserva->espaco->titulo,

                'start' => $reserva->data.'T'.$reserva->hora_inicio,

                'end' => $reserva->data.'T'.$reserva->hora_fim,

            ];
        }

        return response()->json($eventos);
    }

    public function calendario()
    {
        return view('reservas.calendario');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Reserva $reserva)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Reserva $reserva)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Reserva $reserva)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Reserva $reserva)
    {
        //
    }
}
