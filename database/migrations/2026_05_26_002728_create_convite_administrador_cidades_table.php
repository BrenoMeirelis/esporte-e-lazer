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
        Schema::create('convite_administrador_cidades', function (Blueprint $table) {
            $table->id();

            $table->foreignId('cidade_id')->constrained('cidades')->cascadeOnDelete();
            $table->foreignId('convidado_por')->constrained('users')->cascadeOnDelete();

            $table->string('email');
            $table->string('token')->unique();

            $table->enum('status', ['pendente', 'aceito', 'rejeitado'])->default('pendente');

            $table->timestamp('respondido_em')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('convite_administrador_cidades');
    }
};
