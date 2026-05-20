<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('subtitle')->nullable();
            $table->longText('body')->nullable();
            $table->string('main_image_path')->nullable();
            $table->string('location')->nullable();
            $table->date('event_date')->nullable();
            $table->boolean('published')->default(true);
            $table->timestamps();

            $table->index(['published', 'event_date']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
