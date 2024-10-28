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
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id')->constrained()->onUpdate('cascade')
                                                        ->onDelete('cascade');
            $table->foreignId('department_id')->constrained('departments');
            $table->string('employee_name');// Prenumele salariatului
            $table->string('employee_lastname');// Numele salariatului
            $table->unique(['employee_name', 'employee_lastname']);// Nume si Prenume unice ale salariatului
            $table->string('status')->default('inactive'); // Statusul salariatului
            $table->string('email'); // Adresa de email
            $table->string('phone')->nullable(); // Numărul de telefon
            $table->string('address')->nullable(); // Adresa
            $table->string('photo')->default('default_photo.jpg'); // Poza salariatului
            $table->string('id_card')->nullable(); // Seria și numărul buletinului
            $table->string('id_card_issued_by')->nullable(); // Eliberat de
            $table->date('id_card_issue_date')->nullable(); // Data eliberării
            $table->string('cnp')->nullable(); // CNP
            $table->string('bank_account_number')->nullable(); // Numărul contului bancar
            $table->string('bank_name')->nullable(); // Numele bancii
            $table->string('iban')->nullable(); // IBAN
            $table->string('swift_code')->nullable(); // Cod SWIFT
            $table->string('nationality')->nullable();//Nationalitatea
            $table->string('sex')->nullable(); // Sexul
            $table->string('birth_place')->nullable(); // Localitatea nașterii
            $table->string('birth_date')->nullable(); // Data nașterii
            $table->string('marital_status')->nullable(); // Starea civila
            $table->string('children')->nullable(); // Numărul de copii
            $table->string('education')->nullable(); // Educația
            $table->string('degree')->nullable(); // Gradul de instruire
            $table->string('job_title')->nullable(); // Titlul de job
            $table->string('job_description')->nullable(); // Descrierea jobului
            $table->string('job_function')->nullable(); // Functia jobului
            $table->string('job_location')->nullable(); // Locația jobului
            $table->string('job_start_date')->nullable(); // Data începerii jobului
            $table->string('job_end_date')->nullable(); // Data sfârșitului jobului
            $table->string('job_salary')->nullable(); // Salariul jobului
            $table->string('job_salary_currency')->default('RON'); // Moneda jobului
            $table->string('job_benefits')->nullable(); // Beneficii jobului
            $table->string('job_responsibilities')->nullable(); // Responsabilități jobului
            $table->string('job_requirements')->nullable(); // Cerințe jobului
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
