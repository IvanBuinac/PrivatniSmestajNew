<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAccommodationUnitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accommodation_units', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('accommodation_id')->unsigned()->index();
            $table->foreign('accommodation_id')->references('id')->on('accommodation')->onDelete('cascade')->onUpdate('cascade');
            $table->longText('description');
            $table->integer('space_number');
            $table->integer('species_id')->unsigned()->index();
            $table->foreign('species_id')->references('id')->on('species')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::drop('accommodation_units');
    }
}
