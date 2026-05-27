<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Cidade;
use Illuminate\Auth\Access\Response;

class CidadePolicy
{
    public function before(User $user, string $ability): bool|null
    {
        if ($user->tipo === 'super_admin') {
            return true;
        }

        return null;
    }

    public function index(User $user): Response
    {
        return Response::allow();
    }

    public function show(User $user, Cidade $cidade): Response
    {
        return $user->isAdminDaCidade($cidade->id)
            ? Response::allow()
            : Response::deny('Você não pode gerenciar a cidade.');
    }

    public function create(User $user): Response
    {
        return $user->is_admin == 1
            ? Response::allow()
            : Response::deny('Apenas Super Admin pode criar cidades.');
    }

    public function update(User $user, Cidade $cidade): Response
    {
        return $user->isAdminDaCidade($cidade->id)
            ? Response::allow()
            : Response::deny('Você não tem permissão para editar esta cidade.');
    }

    public function delete(User $user, Cidade $cidade): Response
    {
        return $user->isSuperAdmin()
            ? Response::allow()
            : Response::deny('Apenas Super Admin pode excluir cidades.');
    }

    public function manageAdmins(User $user, Cidade $cidade): Response
    {
        return $user->isAdminDaCidade($cidade->id)
            ? Response::allow()
            : Response::deny('Você não pode gerenciar administradores desta cidade.');
    }

    public function inviteAdmins(User $user, Cidade $cidade): Response
    {
        return $user->isAdminDaCidade($cidade->id)
            ? Response::allow()
            : Response::deny('Você não pode convidar administradores para esta cidade.');
    }
}
