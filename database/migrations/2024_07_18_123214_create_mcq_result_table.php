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
        Schema::create('mcq_result', function (Blueprint $table) {

            $table->id('mcq_result_id');
            $table->string('main_policy_id');
            $table->string('main_employee_id');
            $table->integer('marks');
            $table->string('date_time');
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mcq_result');
    }
};
