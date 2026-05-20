<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('brands', function (Blueprint $table) {
            // Si la marca se muestra o no en el carrusel público de la home
            $table->boolean('show_in_carousel')->default(false)->after('active');
            // Orden manual dentro del carrusel
            $table->unsignedInteger('carousel_order')->default(0)->after('show_in_carousel');
            // URL externa opcional (sitio del proveedor)
            $table->string('website_url')->nullable()->after('description');
        });
    }

    public function down(): void
    {
        Schema::table('brands', function (Blueprint $table) {
            $table->dropColumn(['show_in_carousel', 'carousel_order', 'website_url']);
        });
    }
};
