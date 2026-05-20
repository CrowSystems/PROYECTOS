<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // logo_mime: tipo MIME del archivo (image/png, image/svg+xml, etc.)
        Schema::table('brands', function (Blueprint $table) {
            $table->string('logo_mime', 100)->nullable()->after('logo_path');
        });

        // logo_data: contenido binario del archivo. Usamos LONGBLOB para
        // permitir archivos de hasta 4 GB (mucho más de lo que necesitamos).
        DB::statement('ALTER TABLE brands ADD COLUMN logo_data LONGBLOB NULL');
    }

    public function down(): void
    {
        Schema::table('brands', function (Blueprint $table) {
            $table->dropColumn(['logo_mime', 'logo_data']);
        });
    }
};
