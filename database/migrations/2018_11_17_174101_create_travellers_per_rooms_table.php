<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTravellersPerRoomsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('travellers_per_rooms', function (Blueprint $table) {
            $table->increments('travellers_per_room_id')->unsigned(); //wordt alleen gebruikt door eloquent zelf
            $table->integer('rooms_hotel_trip_id')->unsigned();
            $table->integer('traveller_id')->unsigned();
            $table->timestamps();
            $table->foreign('rooms_hotel_trip_id')->references('rooms_hotel_trip_id')->on('rooms_per_hotel_per_trips');
            $table->foreign('traveller_id')->references('traveller_id')->on('travellers')->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('travellers_per_room');
    }
}
