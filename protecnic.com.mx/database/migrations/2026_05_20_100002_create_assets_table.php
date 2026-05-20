<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('assets', function (Blueprint $table) {
            $table->id();

            // Identificación
            $table->string('code')->unique();                  // PROTECNIC-1, PROTECNIC-CEL-001, etc.
            $table->foreignId('asset_type_id')
                  ->constrained('asset_types')
                  ->restrictOnDelete();

            // Marca / modelo / costos
            $table->string('brand')->nullable();
            $table->string('model')->nullable();
            $table->decimal('cost', 12, 2)->nullable();

            // Identificadores técnicos
            $table->string('serial_number')->nullable()->index();
            $table->string('service_tag')->nullable()->index();

            // Especificaciones (aplicables principalmente a PC/laptops)
            $table->string('processor')->nullable();
            $table->string('ram')->nullable();
            $table->string('disk')->nullable();
            $table->string('operating_system')->nullable();
            $table->string('mac_ethernet', 32)->nullable();
            $table->string('mac_wifi', 32)->nullable();

            // Ubicación y notas
            $table->string('location')->nullable();
            $table->text('notes')->nullable();

            // Fechas operativas
            $table->date('registered_at')->nullable();
            $table->date('last_maintenance_at')->nullable();

            // Estado operativo:
            //  - available    : libre, sin asignación vigente
            //  - assigned     : asignado a una persona
            //  - maintenance  : en reparación / mantenimiento
            //  - decommissioned : dado de baja del inventario
            $table->enum('status', ['available', 'assigned', 'maintenance', 'decommissioned'])
                  ->default('available')
                  ->index();

            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('assets');
    }
};
