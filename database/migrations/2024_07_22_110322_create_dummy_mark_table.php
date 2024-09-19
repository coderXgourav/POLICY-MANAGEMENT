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
        Schema::create('dummy_mark', function (Blueprint $table) {
            $table->id('dummy_mark_id');
            $table->string('user_main_id');
            $table->string('policy_main_id');
            $table->integer('dummy_mark')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dummy_mark');
    }
};