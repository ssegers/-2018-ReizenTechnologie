<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRoomsPerHotelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rooms_per_hotel_per_trip', function (Blueprint $table) {
            $table->increments('rooms_per_hotel_per_trip_id');
            $table->integer('hotel_id')->unsigned();
            $table->integer('room_id')->unsigned();
            $table->timestamps();

            $table->foreign('hotel_id')->references('hotel_id')->on('hotels');
            $table->foreign('room_id')->references('room_id')->on('rooms');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rooms_per__hotels');
    }
}
