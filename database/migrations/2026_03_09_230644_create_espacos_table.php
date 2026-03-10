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
    Schema::create('espacos', function (Blueprint $table) {
        $table->id();

        $table->foreignId('cidade_id')->constrained()->onDelete('cascade');

        $table->string('titulo');
        $table->text('descricao');

        $table->time('horario_abertura');
        $table->time('horario_encerramento');

        $table->integer('periodo_max_reserva');

        $table->string('localizacao');

        $table->text('regras')->nullable();
        $table->text('observacoes')->nullable();

        $table->integer('min_participantes');
        $table->integer('max_participantes');

        $table->text('materiais')->nullable();

        $table->string('responsavel');

        $table->string('foto')->nullable();

        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('espacos');
    }
};
