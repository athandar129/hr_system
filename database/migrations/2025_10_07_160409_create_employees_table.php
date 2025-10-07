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
             $table->string('employee_code')->unique();
    $table->string('title')->nullable();
    $table->string('local_first_name');
    $table->string('local_last_name')->nullable();
    $table->string('eng_first_name');
    $table->string('eng_last_name')->nullable();
    $table->enum('gender', ['male', 'female', 'other'])->nullable();
    $table->string('marital_status')->nullable();
    $table->string('emp_type')->nullable(); // permanent, contract, intern
    $table->string('work_type')->default('fulltime'); // fulltime, parttime, freelance, contract
    $table->string('employment_status')->default('active'); // active, suspended, resigned
    $table->string('uid')->unique();
    $table->string('email')->unique();
    $table->string('phone')->nullable();
    $table->string('nationality')->nullable();
    $table->string('race')->nullable();
    $table->string('religion')->nullable();
    $table->string('address')->nullable();
    $table->string('city')->nullable();
    $table->string('qualification')->nullable();

    // Relationships
    $table->foreignId('division_id')->nullable()->constrained()->nullOnDelete();
    $table->foreignId('department_id')->nullable()->constrained()->nullOnDelete();
    $table->foreignId('position_id')->nullable()->constrained()->nullOnDelete();
    $table->foreignId('positionlvl_id')->nullable()->constrained()->nullOnDelete();
    $table->foreignId('work_location_id')->nullable()->constrained()->nullOnDelete();
    $table->foreignId('leave_rule_id')->nullable()->constrained()->nullOnDelete();

    // Dates
    $table->date('dob')->nullable();
    $table->date('hired_at')->nullable();
    $table->date('joined_at')->nullable();

    // Other info
    $table->string('approve_person')->nullable();
    $table->decimal('salary', 15, 2)->nullable();
    $table->string('photo')->nullable();
    $table->enum('role', ['staff', 'manager', 'admin'])->default('staff');
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
