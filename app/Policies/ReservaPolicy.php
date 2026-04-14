<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Reserva;
use Illuminate\Auth\Access\Response;

class ReservaPolicy
{
    public function index(User $user)
    {
        return Response::allow();
    }

    public function show(User $user, Reserva $reserva)
    {
        if ($user->tipo == 'admin' || $reserva->user_id == $user->id)
            return Response::allow();

        return Response::deny('Você não pode ver essa reserva');
    }

    public function create(User $user)
    {
        return Response::allow(); // qualquer logado pode reservar
    }

    public function update(User $user, Reserva $reserva)
    {
        if ($user->tipo == 'admin' || $reserva->user_id == $user->id)
            return Response::allow();

        return Response::deny('Você não pode editar essa reserva');
    }

    public function delete(User $user, Reserva $reserva)
    {
        if ($user->tipo == 'admin' || $reserva->user_id == $user->id)
            return Response::allow();

        return Response::deny('Você não pode excluir essa reserva');
    }
}
