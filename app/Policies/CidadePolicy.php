<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Cidade;
use Illuminate\Auth\Access\Response;

class CidadePolicy
{
    public function index(User $user)
    {
        return Response::allow(); // todos logados podem ver
    }

    public function show(User $user, Cidade $cidade)
    {
        return Response::allow();
    }

    public function create(User $user)
    {
        return $user->tipo == 'admin'
            ? Response::allow()
            : Response::deny('Apenas admins podem criar cidades');
    }

    public function update(User $user, Cidade $cidade)
    {
        return $user->tipo == 'admin'
            ? Response::allow()
            : Response::deny('Apenas admins podem editar cidades');
    }

    public function delete(User $user, Cidade $cidade)
    {
        return $user->tipo == 'admin'
            ? Response::allow()
            : Response::deny('Apenas admins podem excluir cidades');
    }
}
