<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateStatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('states', function(Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('path');
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();
            $table->integer('zoom')->nullable();
            $table->integer('status');
            $table->softDeletes();
            $table->timestamps();
        });
        DB::table('states')->insert(
            array(
                "name"=>'{"sr":"Srbija","en":"Serbia"}',
                "path"=>'{"sr":"srbija","en":"serbia"}',
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
        Schema::drop('states');
    }
}
