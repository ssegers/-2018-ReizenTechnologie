<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTravellersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('travellers', function (Blueprint $table) {
            $table->increments('traveller_id');
            $table->integer("user_id");
            $table->string("firstname");
            $table->string("lastname");
            $table->string("country");
            $table->string("address");
            $table->string("gender");
            $table->string("phone");
            $table->string("emergency_phone_1");
            $table->string("emergency_phone_2")->nullable();
            $table->string("nationality");
            $table->string("birthdate");
            $table->string("birthplace");
            $table->boolean("medical_issue");
            $table->string("medical_info")->nullable();
            $table->rememberToken();
            $table->timestamps();
            $table->foreign("user_id")->references("id")->on("users");




        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('travellers');
    }
}
