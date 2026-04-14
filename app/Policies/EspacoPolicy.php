<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Espaco;
use Illuminate\Auth\Access\Response;

class EspacoPolicy
{
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
        return $user->tipo == 'admin'
            ? Response::allow()
            : Response::deny('Apenas admins podem criar espaços');
    }

    public function update(User $user, Espaco $espaco)
    {
        return $user->tipo == 'admin'
            ? Response::allow()
            : Response::deny('Apenas admins podem editar espaços');
    }

    public function delete(User $user, Espaco $espaco)
    {
        return $user->tipo == 'admin'
            ? Response::allow()
            : Response::deny('Apenas admins podem excluir espaços');
    }
}
