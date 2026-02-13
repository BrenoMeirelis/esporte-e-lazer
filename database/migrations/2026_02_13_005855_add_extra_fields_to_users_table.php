<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
        $table->string('nome')->after('id');
        $table->string('sobrenome')->after('nome');
        $table->string('cpf')->unique()->after('email');
        $table->string('telefone')->nullable()->after('cpf');
        $table->date('data_nascimento')->after('telefone');
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
        $table->dropColumn([
            'nome',
            'sobrenome',
            'cpf',
            'telefone',
            'data_nascimento'
        ]);
    });
    }
};
