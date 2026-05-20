<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // MySQL: ampliar el ENUM de roles para incluir it_manager
        DB::statement("
            ALTER TABLE users
            MODIFY COLUMN role
            ENUM('admin','content_editor','report_supervisor','technician','it_manager')
            NOT NULL DEFAULT 'technician'
        ");
    }

    public function down(): void
    {
        DB::statement("
            ALTER TABLE users
            MODIFY COLUMN role
            ENUM('admin','content_editor','report_supervisor','technician')
            NOT NULL DEFAULT 'technician'
        ");
    }
};
