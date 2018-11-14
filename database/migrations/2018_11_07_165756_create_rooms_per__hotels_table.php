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
        Schema::create('rooms_per__hotels', function (Blueprint $table) {
            $table->integer('hotel_id')->unsigned();
            $table->integer('room_id')->unsigned();
            $table->timestamps();

            $table->primary(['hotel_id', 'room_id']);
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
