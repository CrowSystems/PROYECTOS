<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('reports', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();

            // Quién genera
            $table->foreignId('technician_id')->constrained('users')->cascadeOnDelete();

            // Datos del cliente y servicio
            $table->foreignId('client_id')->nullable()->constrained('clients')->nullOnDelete();
            $table->foreignId('machine_id')->nullable()->constrained('machines')->nullOnDelete();
            $table->foreignId('product_id')->nullable()->constrained('products')->nullOnDelete();
            $table->string('machine_name_snapshot')->nullable();
            $table->string('product_type_snapshot')->nullable();
            $table->date('service_date')->nullable();
            $table->text('observations')->nullable();

            // Firma digital del cliente (in-app, hecha en sitio)
            $table->string('client_signature_path')->nullable();
            $table->string('client_signed_name')->nullable();
            $table->timestamp('client_signed_at')->nullable();

            // Segunda aprobación remota desde correo
            $table->string('client_approval_token', 64)->nullable()->index();
            $table->timestamp('client_email_sent_at')->nullable();
            $table->timestamp('client_approved_at')->nullable();
            $table->ipAddress('client_approval_ip')->nullable();

            // Validación del supervisor
            $table->foreignId('supervisor_id')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamp('supervisor_reviewed_at')->nullable();
            $table->text('supervisor_notes')->nullable();

            // Estado general
            $table->enum('status', [
                'draft',
                'signed_in_site',
                'pending_client_approval',
                'client_approved',
                'supervisor_approved',
                'rejected',
            ])->default('draft');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('reports');
    }
};
