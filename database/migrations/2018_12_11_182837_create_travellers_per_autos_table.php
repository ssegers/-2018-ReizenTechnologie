<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTravellersPerAutosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('travellers_per_autos', function (Blueprint $table) {
            $table->increments('travellers_per_auto_id')->unsigned(); //wordt alleen gebruikt door eloquent zelf
            $table->integer('autos_per_trip_id')->unsigned();
            $table->integer('traveller_id')->unsigned();
            $table->timestamps();
            $table->foreign('autos_per_trip_id')->references('autos_per_trip_id')->on('autos_per_trips');
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
        Schema::dropIfExists('travellers_per_autos');
    }
}
