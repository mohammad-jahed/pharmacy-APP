<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAlternativeMedicinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alternative_medicines', function (Blueprint $table) {
            $table->id();
            $table->foreignId('medicine_id');
            $table->foreignId('alternative_id')->references('id')->on('medicines');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('alternative_medicines');
    }
}
