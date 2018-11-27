<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTravellersPerTripTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('travellers_per_trip', function (Blueprint $table) {
            $table->integer('trip_id')->unsigned();
            $table->integer('traveller_id')->unsigned();
            $table->timestamps();
            $table->foreign('trip_id')->references('trip_id')->on('trips');
            $table->foreign('traveller_id')->references('traveller_id')->on('travellers');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('trip_organizers');
    }
}
