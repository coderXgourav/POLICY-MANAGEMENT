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
        Schema::create('signature', function (Blueprint $table) {
            $table->id('signature_id');
            $table->string('main_employee_id');
            $table->string('main_policy_id');
            $table->text('signature');
            $table->integer('signature_status')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('signature');
    }
};