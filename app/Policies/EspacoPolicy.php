<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Espaco;
use Illuminate\Auth\Access\Response;

class EspacoPolicy
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

    public function show(User $user, Espaco $espaco)
    {
        return Response::allow();
    }

    public function create(User $user)
    {
        return Response::deny();
    }

    public function update(User $user, Espaco $espaco)
    {
        return Response::deny();
    }

    public function delete(User $user, Espaco $espaco)
    {
        return Response::deny();
    }
}
