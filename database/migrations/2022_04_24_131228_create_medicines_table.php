<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMedicinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medicines', function (Blueprint $table) {
            $table->id();
            $table->json('shelf_ids')->nullable();
            $table->foreignId('company_id')->nullable();
            $table->json('material_ids')->nullable();
            $table->json('alternative_ids')->nullable();
            $table->string('name_en');
            $table->string('name_ar');
            $table->integer('quantity');
            $table->integer('pills');
            $table->date('expiration_date');
            $table->integer('c_price');
            $table->integer('price');
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
        Schema::dropIfExists('medicines');
    }
}
