<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {

        User::firstOrCreate(
            ['email' => 'admin@admin.com'],
            [
                'name' => 'Administrador',
                'cpf' => '00000000000',
                'data_nascimento' => '2000-01-01',
                'password' => Hash::make('12345678'),
                'is_admin' => true
            ]
        );

    }
}
