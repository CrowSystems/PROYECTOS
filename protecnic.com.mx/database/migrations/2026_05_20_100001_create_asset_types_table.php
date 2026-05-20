<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('asset_types', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();          // Laptop, PC de escritorio, Celular, Switch...
            $table->string('slug')->unique();          // laptop, pc-escritorio, celular...
            $table->string('icon')->nullable();        // opcional, para mostrar un ícono
            $table->text('description')->nullable();
            $table->boolean('active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('asset_types');
    }
};
