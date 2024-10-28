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
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Numele companiei
            $table->string('address'); // Adresa companiei
            $table->string('city'); // Orasul companiei
            $table->string('email'); // Adresa de email a companiei
            $table->string('website'); // Adresa website a companiei
            $table->string('iban')->nullable(); // Cod IBAN
            $table->string('bank')->nullable(); // Numele bancii
            $table->string('bank_address')->nullable(); // Adresa bancii
            $table->string('bank_city')->nullable(); // Orasul bancii
            $table->string('bank_swift')->nullable(); // Cod SWIFT
            $table->string('billing_name')->nullable(); // Numele registrului comerțului
            $table->string('billing_address')->nullable(); // Adresa registrului comerțului
            $table->string('billing_j')->nullable(); // Număr de înregistrare la registrul comerțului
            $table->string('billing_cui')->nullable(); // Cod fiscal
            $table->string('phone'); // Telefon
            $table->string('admin_name'); // Reprezentant legal
            $table->string('admin_title'); // Titlul reprezentantului legal
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('companies');
    }
};
