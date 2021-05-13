<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCityTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('city', function(Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('path');
            $table->integer('states_id')->unsigned()->index();
            $table->foreign("states_id")
                ->references('id')
                ->on('states')
                ->onDelete('cascade');
            $table->string('latitude');
            $table->string('longitude');
            $table->integer('zoom');
            $table->string('status');
            $table->softDeletes();
            $table->timestamps();
        });
        DB::table('city')->insert(
            array(
                "name"=>'{"sr":"Beograd","en":"Belgrade"}',
                "path"=>'{"sr":"beograd","en":"belgrade"}',
                "states_id"=>'1',
                "latitude"=>'1',
                "longitude"=>'1',
                "zoom"=>'15',
                "status"=>'1',
                'created_at'    =>  date('Y-m-d H:i:s'),
                'updated_at'    =>  date('Y-m-d H:i:s')
            )
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('city');
    }
}
