<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

use App\Models\User;
use App\Models\Cidade;
use App\Models\Espaco;
use App\Models\Reserva;

use App\Policies\UserPolicy;
use App\Policies\CidadePolicy;
use App\Policies\EspacoPolicy;
use App\Policies\ReservaPolicy;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        User::class => UserPolicy::class,
        Cidade::class => CidadePolicy::class,
        Espaco::class => EspacoPolicy::class,
        Reserva::class => ReservaPolicy::class,
    ];

    public function boot(): void
    {
        $this->registerPolicies();
    }
}
