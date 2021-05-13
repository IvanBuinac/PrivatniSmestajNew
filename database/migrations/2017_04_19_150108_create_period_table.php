<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePeriodTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('period', function(Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('picture');
            $table->softDeletes();
            $table->timestamps();
        });

        DB::table('period')->insert(
            array(
                "name"=>'{"en":"Summer","sr":"Leto"}',
                "picture"=>"leto.png",
                'created_at'    =>  date('Y-m-d H:i:s'),
                'updated_at'    =>  date('Y-m-d H:i:s')
            )
        );
        DB::table('period')->insert(
            array(
                "name"=>'{"en":"Winter","sr":"Zima"}',
                "picture"=>"zima.png",
                'created_at'    =>  date('Y-m-d H:i:s'),
                'updated_at'    =>  date('Y-m-d H:i:s')
            )
        );
        DB::table('period')->insert(
            array(
                "name"=>'{"en":"Autumn","sr":"Jesen"}',
                "picture"=>"jesen.png",
                'created_at'    =>  date('Y-m-d H:i:s'),
                'updated_at'    =>  date('Y-m-d H:i:s')
            )
        );
        DB::table('period')->insert(
            array(
                "name"=>'{"en":"Spring","sr":"Prolece"}',
                "picture"=>"prolece.png",
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
        Schema::drop('period');
    }
}
