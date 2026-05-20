<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // ID único del usuario en Microsoft Entra (claim "oid" / "sub").
            // Lo guardamos para vincular la cuenta de Microsoft con el User de la app.
            $table->string('microsoft_id', 64)->nullable()->unique()->after('email');

            // Cache opcional del payload de Microsoft (nombre completo, foto URL, etc.)
            $table->json('microsoft_data')->nullable()->after('microsoft_id');

            // Marcas si el usuario fue creado por SSO (no por admin manual)
            $table->boolean('created_via_sso')->default(false)->after('microsoft_data');

            // Último login con Microsoft
            $table->timestamp('last_microsoft_login_at')->nullable()->after('created_via_sso');
        });

        // Los usuarios que entren por Microsoft NO tienen password en nuestra BD.
        // Hacemos password nullable para que sea opcional.
        DB::statement('ALTER TABLE users MODIFY COLUMN password VARCHAR(255) NULL');
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['microsoft_id', 'microsoft_data', 'created_via_sso', 'last_microsoft_login_at']);
        });

        DB::statement('ALTER TABLE users MODIFY COLUMN password VARCHAR(255) NOT NULL');
    }
};
