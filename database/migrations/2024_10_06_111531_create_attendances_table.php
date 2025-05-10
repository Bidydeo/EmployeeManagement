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
        Schema::create('attendances', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employee_id')->constrained(); // Legătura cu angajatul
            $table->foreignId('location_id')->constrained('locations')->cascadeOnDelete(); // Legătura cu locația
            $table->date('date'); // Data
            $table->time('clock_in_time')->nullable(); // Ora clock in
            $table->time('clock_out_time')->nullable(); // Ora clock out
            $table->decimal('latitude_in', 10, 7)->nullable(); // Latitudine la clock in/out
            $table->decimal('longitude_in', 10, 7)->nullable(); // Longitudine la clock in/out
            $table->decimal('latitude_out', 10, 7)->nullable(); // Latitudine la clock in/out
            $table->decimal('longitude_out', 10, 7)->nullable(); // Longitudine la clock in/out
            $table->softDeletes(); // adaugă coloana deleted_at
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attendances');
    }
};
