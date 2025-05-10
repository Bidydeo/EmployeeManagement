<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('locations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id')->constrained(); // Legătura cu compania
            $table->foreignId('project_id')->constrained();
            $table->string('name');
            $table->decimal('latitude', 10, 7); // Latitudine
            $table->decimal('longitude', 10, 7); // Longitudine
            $table->decimal('radius', 8, 2)->default(300); // Rază default 300m
            $table->softDeletes(); // adaugă coloana deleted_at
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('locations');
    }
};
