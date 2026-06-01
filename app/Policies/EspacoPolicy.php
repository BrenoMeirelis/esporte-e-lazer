<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Espaco;
use App\Models\Cidade;
use Illuminate\Auth\Access\Response;

class EspacoPolicy
{
    public function before(User $user, $ability)
    {
        if ($user->tipo === 'super_admin') {
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

    public function update(User $user, Espaco $espaco)
    {
        return $user->isAdminDaCidade($espaco->cidade_id);
    }

    public function delete(User $user, Espaco $espaco)
    {
        return $user->isAdminDaCidade($espaco->cidade_id);
    }

    public function create(User $user, Cidade $cidade)
    {
        return $user->isAdminDaCidade($cidade->id);
    }

    public function viewAny(User $user, Cidade $cidade)
    {
        return Response::allow();
    }
}
