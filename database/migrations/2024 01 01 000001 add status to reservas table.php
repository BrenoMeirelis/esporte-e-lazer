<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('reservas', function (Blueprint $table) {
            // Só adiciona se a coluna ainda não existir
            if (!Schema::hasColumn('reservas', 'status')) {
                $table->enum('status', ['pendente', 'aprovada', 'recusada'])
                    ->default('pendente')
                    ->after('hora_fim');
            }

            if (!Schema::hasColumn('reservas', 'motivo_recusa')) {
                $table->text('motivo_recusa')->nullable()->after('status');
            }
        });
    }

    public function down(): void
    {
        Schema::table('reservas', function (Blueprint $table) {
            $table->dropColumn(['status', 'motivo_recusa']);
        });
    }
};
