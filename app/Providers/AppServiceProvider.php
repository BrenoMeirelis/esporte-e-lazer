<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

// MODELS
use App\Models\User;
use App\Models\Cidade;
use App\Models\Espaco;
use App\Models\Reserva;

// POLICIES
use App\Policies\UserPolicy;
use App\Policies\CidadePolicy;
use App\Policies\EspacoPolicy;
use App\Policies\ReservaPolicy;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * Mapeamento de policies
     */
    protected $policies = [
        User::class => UserPolicy::class,
        Cidade::class => CidadePolicy::class,
        Espaco::class => EspacoPolicy::class,
        Reserva::class => ReservaPolicy::class,
    ];

    /**
     * Registrar policies
     */
    public function boot(): void
    {
        // 🔥 ESSENCIAL: registra automaticamente todas as policies acima
        $this->registerPolicies();
    }
}
