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
        $table->string('employee_id')->unique();
        $table->string('name');
        $table->string('email')->nullable();
        $table->string('phone')->nullable();
        $table->unsignedBigInteger('department_id')->nullable();
        $table->unsignedBigInteger('division_id')->nullable();
        $table->unsignedBigInteger('position_id')->nullable();
        $table->string('position_level')->nullable();
        $table->decimal('basic_salary', 12, 2)->nullable();
        $table->date('join_date')->nullable();
        $table->timestamps();

        // Example: Add foreign keys (optional)
        $table->foreign('department_id')->references('id')->on('departments')->onDelete('set null');
        $table->foreign('division_id')->references('id')->on('divisions')->onDelete('set null');
        $table->foreign('position_id')->references('id')->on('positions')->onDelete('set null');
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
