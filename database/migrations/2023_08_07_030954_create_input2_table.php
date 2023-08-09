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
        Schema::create('input2', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->double('turbin_speed');
            $table->double('rotor_vib_monitor');
            $table->double('axial_displacement_monitor');
            $table->double('main_steam');
            $table->double('stage_steam');
            $table->double('exhaust');
            $table->double('lub_oil');
            $table->double('control_oil');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('input2');
    }
};
