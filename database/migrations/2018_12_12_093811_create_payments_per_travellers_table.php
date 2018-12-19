<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentsPerTravellersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments_per_travellers', function (Blueprint $table) {
                $table->increments('paymentPerTravellers_id');
                $table->string('payment_date')->nullable();
                $table->integer('traveller_id')->unsigned();
                $table->integer('amount')->nullable();
                $table->timestamps();
                $table->foreign('traveller_id')->references('traveller_id')->on('travellers_per_trips')->onDelete("cascade");

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payments_per_travellers');
    }
}
