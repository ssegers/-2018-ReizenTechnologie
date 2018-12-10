<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->increments('payment_id');
            $table->string('payment_date')->nullable();
            $table->integer('travellers_per_trip_id')->unsigned();
            $table->integer('amount')->nullable();
            $table->timestamps();
            $table->foreign('travellers_per_trip_id')->references('travellers_per_trip_id')->on('travellers_per_trips')->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payments');
    }
}
