<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientModelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->id('client_id');
            $table->string('full_name');
            $table->string('phone_num');
            $table->boolean('gender');
            $table->string('address');
        });

        Schema::create('cars', function (Blueprint $table) {
            $table->id('car_id');
            $table->string("color");
            $table->string("model");
            $table->string("brand");
            $table->string('plate_num');
            $table->boolean('on_parking');
            $table->unsignedBigInteger('client_id');
            $table->foreign('client_id')->references('client_id')->on('clients');    
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clients');
    }
}
