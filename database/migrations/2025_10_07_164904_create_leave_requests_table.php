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
        Schema::create('leave_requests', function (Blueprint $table) {
            $table->id();
             $table->foreignId('employee_id')->constrained()->onDelete('cascade');
    $table->string('type'); // sick, annual, unpaid...
    $table->date('start_date');
    $table->date('end_date');
    $table->text('reason')->nullable();
    $table->string('status')->default('pending'); // pending/approved/rejected
    $table->foreignId('approved_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('leave_requests');
    }
};
