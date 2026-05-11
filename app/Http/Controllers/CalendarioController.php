<?php

namespace App\Http\Controllers;

use App\Models\Cidade;
use App\Models\Reserva;
use App\Models\User;

class CalendarioController extends Controller
{
    public function index(Cidade $cidade)
    {
        $user = auth()->user();

        if (!in_array($user->tipo, ['admin', 'super_admin'])) {
            abort(403, 'Acesso não autorizado.');
        }

        if ($user->tipo === 'admin' && $user->cidade_id !== $cidade->id) {
            abort(403, 'Você não pode acessar reservas de outra cidade.');
        }

        $reservas = Reserva::with(['user', 'espaco'])
            ->whereHas('espaco', function ($query) use ($cidade) {
                $query->where('cidade_id', $cidade->id);
            })
            ->orderBy('data')
            ->orderBy('hora_inicio')
            ->get();

        $usuarios = User::where('cidade_id', $cidade->id)->get();

        return view('calendario.index', compact('cidade', 'reservas', 'usuarios'));
    }
}
