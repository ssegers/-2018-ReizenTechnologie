<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTravellersPerTripsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('travellers_per_trips', function (Blueprint $table) {
            $table->increments('travellers_per_trip_id')->unsigned(); //wordt alleen gebruikt door eloquent zelf
            $table->integer('trip_id')->unsigned();
            $table->integer('traveller_id')->unsigned();
            $table->boolean('is_organizer');
            $table->timestamps();
            $table->foreign('trip_id')->references('trip_id')->on('trips');
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
        Schema::dropIfExists('travellers_per_trips');
    }
}
