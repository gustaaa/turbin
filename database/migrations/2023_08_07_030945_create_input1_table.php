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
        Schema::create('input1', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->double('inlet_steam');
            $table->double('exm_steam');
            $table->double('turbin_thrust_bearing');
            $table->double('tb_gov_side');
            $table->double('tb_coup_side');
            $table->double('pb_tbn_side');
            $table->double('pb_gen_side');
            $table->double('wb_tbn_side');
            $table->double('wb_gen_side');
            $table->double('oc_lub_oil_outlet');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('input1');
    }
};
