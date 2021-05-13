<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAccommodationDistancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accommodation_distances', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('accommodation_id')->unsigned()->index();
            $table->foreign('accommodation_id')->references('id')->on('accommodation')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('distance_id')->unsigned()->index();
            $table->foreign('distance_id')->references('id')->on('distances')->onDelete('cascade')->onUpdate('cascade');
            $table->string('distance');
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
        Schema::dropIfExists('accommodation_distances');
    }
}
