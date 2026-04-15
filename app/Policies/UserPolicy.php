<?php

namespace App\Policies;

use Illuminate\Auth\Access\Response;
use App\Models\User;

class UserPolicy
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

    public function edit(User $user, User $usuario)
    {
        return $user->is($usuario)
            ? Response::allow()
            : Response::deny('Sem permissão.');
    }

    public function show(User $user, User $usuario)
    {
        return $user->is($usuario)
            ? Response::allow()
            : Response::deny('Sem permissão.');
    }

    public function delete(User $user, User $usuario)
    {
        return Response::allow();
    }
}
