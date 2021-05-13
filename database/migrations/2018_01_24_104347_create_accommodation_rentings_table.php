<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAccommodationRentingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accommodation_rentings', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('accommodation_id')->unsigned()->index();
            $table->foreign('accommodation_id')->references('id')->on('accommodation')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('renting_id')->unsigned()->index();
            $table->foreign('renting_id')->references('id')->on('rentings')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('accommodation_rentings');
    }
}
