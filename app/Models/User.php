<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;

class User extends Authenticatable implements MustVerifyEmail
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'cpf',
        'telefone',
        'data_nascimento',
        'tipo', // 👈 usa só isso
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'data_nascimento' => 'date',
            'is_admin' => 'boolean'
        ];
    }

    public function cidades()
    {
        return $this->belongsToMany(Cidade::class);
    }

    public function cidadesAdministradas()
    {
        return $this->belongsToMany(Cidade::class, 'cidade_user')
            ->withTimestamps();
    }

    public function isSuperAdmin()
    {
        return $this->is_admin;
    }

    public function isAdminDaCidade($cidadeId)
    {
        return $this->isSuperAdmin()
            || $this->cidadesAdministradas()->where('cidade_id', $cidadeId)->exists();
    }
}
