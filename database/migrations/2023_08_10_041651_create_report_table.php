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
        Schema::create('report', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_input1')->nullable();
            $table->foreign('id_input1')->references('id')->on('input1');
            $table->unsignedBigInteger('id_input2')->nullable();
            $table->foreign('id_input2')->references('id')->on('input2');
            $table->unsignedBigInteger('id_input3')->nullable();
            $table->foreign('id_input3')->references('id')->on('input3');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('report');
    }
};
