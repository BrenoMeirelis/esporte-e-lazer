<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Cidade;
use Illuminate\Auth\Access\Response;

class CidadePolicy
{
    // 🔥 LIBERA ADMIN GLOBAL
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

    public function show(User $user, Cidade $cidade)
    {
        return Response::allow();
    }

    public function create(User $user)
    {
        return Response::deny(); // quem libera é o before()
    }

    public function update(User $user, Cidade $cidade)
    {
        return Response::deny();
    }

    public function delete(User $user, Cidade $cidade)
    {
        return Response::deny();
    }
}
