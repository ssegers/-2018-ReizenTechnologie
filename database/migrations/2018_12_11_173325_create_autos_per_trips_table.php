<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAutosPerTripsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('autos_per_trips', function (Blueprint $table) {
            $table->increments('autos_per_trip_id')->unsigned();
            $table->integer('trip_id')->unsigned();
            $table->integer('auto_id')->unsigned();
            $table->timestamps();
            $table->foreign('trip_id')->references('trip_id')->on('trips');
            $table->foreign('auto_id')->references('auto_id')->on('autos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('autos_per_trips');
    }
}
