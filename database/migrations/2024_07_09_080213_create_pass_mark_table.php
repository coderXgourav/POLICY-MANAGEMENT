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
        Schema::create('pass_mark', function (Blueprint $table) {
            $table->id('pass_mark_id');
            $table->string('policy_main_id');
            $table->float('pass_mark', 8, 2);
            $table->integer('mark_status')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pass_mark');
    }
};
