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
        Schema::create('employee', function (Blueprint $table) {
            $table->id('employee_id');
            $table->string('employee_name');
            $table->string('employee_email');
            $table->string('employee_number');
            // $table->string('employee_state');
            // $table->string('employee_city');
            $table->string('department_id');
            $table->string('employee_password');
            $table->string('employee_policy_status')->default(0);
            $table->string('employee_status')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employee');
    }
};
