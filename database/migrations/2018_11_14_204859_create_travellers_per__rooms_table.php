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
        Schema::create('travellers_per__rooms', function (Blueprint $table) {
            $table->integer('rooms_per_hotel_per_trip_id')->unsigned();
            $table->integer('room_id')->unsigned();
            $table->timestamps();

            $table->primary(['rooms_per_hotel_per_trip_id', 'room_id']);
            $table->foreign('traveller_id')->references('traveller_id')->on('travellers');
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
        Schema::dropIfExists('travellers_per__rooms');
    }
}
