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
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('slug')->unique();
            $table->foreignId('client_id')->constrained('clients')->cascadeOnDelete();
            $table->foreignId('company_id')->constrained('companies')->cascadeOnDelete();
            $table->text('description')->nullable();
            $table->string('projectleader')->nullable();
            $table->enum('status', ['Not Started', 'On Hold', 'Canceled', 'In Progress', 'Completed'])->default('Not Started');
            $table->integer('progress')->default(0);
            $table->integer('budget')->default(0);
            $table->integer('spending')->default(0);
            $table->integer('duration')->default(0);
            $table->double('latitude')->nullable();
            $table->double('longitude')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
