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
            $table->string('company_name');// Numele companiei
            $table->string('company_logo')->nullable();//Logoul companiei
            $table->string('company_reg_com');// Număr de înregistrare la registrul comerțului
            $table->string('company_cui');// Cod fiscal
            $table->string('company_country');// Tara companiei
            $table->string('company_town');// // Orasul companiei
            $table->string('company_district');// Adresa companiei
            $table->string('company_street_name');// Adresa companiei
            $table->string('company_street_no');// Adresa companiei
            $table->string('company_email');// Adresa de email a companiei
            $table->string('company_phone');// Telefon
            $table->string('company_admin');// Reprezentant legal
            $table->string('domeniu_email');//domeniul companiei
            $table->string('website'); // Adresa website a companiei
            $table->string('iban')->nullable(); // Cod IBAN
            $table->string('bank')->nullable(); // Numele bancii
            $table->string('bank_address')->nullable(); // Adresa bancii
            $table->string('bank_city')->nullable(); // Orasul bancii
            $table->string('bank_swift')->nullable(); // Cod SWIFT
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
