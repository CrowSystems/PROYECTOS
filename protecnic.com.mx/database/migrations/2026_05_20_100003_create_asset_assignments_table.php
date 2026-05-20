<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('asset_assignments', function (Blueprint $table) {
            $table->id();

            $table->foreignId('asset_id')
                  ->constrained('assets')
                  ->cascadeOnDelete();

            $table->foreignId('user_id')
                  ->comment('Colaborador a quien se asigna el equipo')
                  ->constrained('users')
                  ->restrictOnDelete();

            $table->foreignId('assigned_by_id')
                  ->nullable()
                  ->comment('Usuario IT que registró la asignación')
                  ->constrained('users')
                  ->nullOnDelete();

            $table->foreignId('released_by_id')
                  ->nullable()
                  ->comment('Usuario IT que liberó la asignación')
                  ->constrained('users')
                  ->nullOnDelete();

            $table->timestamp('assigned_at');
            $table->timestamp('released_at')->nullable();   // null = asignación vigente

            $table->text('assignment_notes')->nullable();
            $table->text('release_notes')->nullable();

            $table->timestamps();

            // Optimización: para encontrar rápido la asignación vigente
            $table->index(['asset_id', 'released_at']);
            $table->index(['user_id',  'released_at']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('asset_assignments');
    }
};
