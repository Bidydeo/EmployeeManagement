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
        Schema::create('employee_team', function (Blueprint $table) {
            $table->id();
            
            // Ne asigurăm că referințele sunt corect formate și se folosesc foreignId
            $table->foreignId('employee_id')
                  ->constrained('employees')
                  ->onDelete('cascade');

            $table->foreignId('team_id')
                  ->constrained('teams')
                  ->onDelete('cascade');

            $table->timestamps();

            // Pentru evitarea dublurilor (opțional, dar recomandat)
            $table->unique(['employee_id', 'team_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employee_team');
    }
};