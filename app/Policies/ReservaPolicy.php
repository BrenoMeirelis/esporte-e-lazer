<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Reserva;
use Illuminate\Auth\Access\Response;

class ReservaPolicy
{
    public function before(User $user, $ability)
    {
        if (in_array($user->tipo, ['admin', 'super_admin'])) {
            return true;
        }
    }

    public function index(User $user)
    {
        return Response::allow();
    }

    public function show(User $user, Reserva $reserva)
    {
        return $reserva->user_id == $user->id
            ? Response::allow()
            : Response::deny();
    }

    public function create(User $user)
    {
        return Response::allow();
    }

    public function update(User $user, Reserva $reserva)
    {
        return $reserva->user_id == $user->id
            ? Response::allow()
            : Response::deny();
    }

    public function delete(User $user, Reserva $reserva)
    {
        return $reserva->user_id == $user->id
            ? Response::allow()
            : Response::deny();
    }
}
