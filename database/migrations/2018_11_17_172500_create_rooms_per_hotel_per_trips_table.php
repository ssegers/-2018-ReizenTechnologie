<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRoomsPerHotelPerTripsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rooms_per_hotel_per_trips', function (Blueprint $table) {
            $table->increments('rooms_hotel_trip_id');
            $table->integer('hotels_per_trip_id')->unsigned();
            $table->integer('size');
            $table->timestamps();

            $table->foreign('hotels_per_trip_id')->references('hotels_per_trip_id')->on('hotels_per_trips');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rooms_per_hotel_per_trips');
    }
}
