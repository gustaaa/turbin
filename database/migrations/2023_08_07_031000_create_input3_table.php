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
        Schema::create('input3', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->double('temp_water_in');
            $table->double('temp_water_out');
            $table->double('temp_oil_in');
            $table->double('temp_oil_out');
            $table->double('vacum');
            $table->double('injector');
            $table->double('speed_drop');
            $table->double('load_limit');
            $table->double('flo_in');
            $table->double('flo_out');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('input3');
    }
};
