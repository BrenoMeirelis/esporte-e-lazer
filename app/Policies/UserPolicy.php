<?php

namespace App\Policies;
use Illuminate\Auth\Access\Response;

use App\Models\User;

class UserPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    public function index($user)
    {
        if ($user->role == 'super_admin')
            return Response::allow();
        else
            return Response::deny('Apenas administradores podem ter acesso a lista de usuários.');
    }

    public function edit($user, User $usuario)
    {
        if ($user->role == 'super_admin' || $user->is($usuario))
            return Response::allow();
        else
            return Response::deny('Apenas administradores ou o dono do perfil tem acesso a edição');
    }

    public function show($user, User $usuario)
    {
        if ($user->role == 'super_admin' || $user->is($usuario))
            return Response::allow();
        else
            return Response::deny('Apenas administradores ou o dono do perfil tem acesso ao perfil');
    }

    public function delete($user, User $usuario)
{
    if ($user->role == 'super_admin' || $user->is($usuario))
        return Response::allow();
    else
        return Response::deny('Sem permissão para excluir');
}

}
