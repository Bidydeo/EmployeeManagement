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
        Schema::create('leaves', function (Blueprint $table) {
            $table->id();
    
            // Relație cu tabelul employees
            $table->foreignId('employee_id')->constrained('employees')->onDelete('cascade');
    
            // Relație cu leave_types (tipurile de concediu)
            $table->foreignId('leave_type_id')->nullable()->constrained('leave_types')->onDelete('set null');
    
            // Data de început și sfârșit a concediului
            $table->date('start_date');
            $table->date('end_date');
    
            // Înlocuitor pentru perioada concediului
            $table->foreignId('substitute_employee_id')->nullable()->constrained('employees')->onDelete('set null');
        
            // Dacă este aprobat de substitut (true), atunci substituteApproval va fi true, altfel va fi false
            $table->boolean('substituteApproved')->default(false);

             // Relație cu managerul (persoana care aprobă/rejectează)
            $table->foreignId('manager_id')->constrained('employees')->onDelete('cascade');

            // Dacă este aprobat de manager (true), atunci managerApproval va fi true, altfel va fi false 
            $table->boolean('managerApproved')->default(false);
    
            // Statusul de aprobare (Pending, Approved, Rejected)
            $table->enum('status', ['Pending', 'ApprovedBySubstitute','RejectedBySubstitute','Approved', 'Rejected'])->default('Pending');

            // Motivul cererii de concediu
            $table->string('reason')->nullable();

            // Data de actiune (dacă este aprobată/respinsa de manager sau de substitut)
            $table->date('substitute_action_date')->nullable();
            $table->date('manager_action_date')->nullable();

            // Comentarii (opțional)
            $table->text('comments')->nullable();
    
            // Timestamps
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('leaves');
    }
};
