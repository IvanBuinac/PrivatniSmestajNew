<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function(Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->softDeletes();
            $table->timestamps();
        });

        DB::table('categories')->insert(
            array(
                "name"=>'{"en":"1 Star","sr":"1 Zvezdica"}',
                'created_at'    =>  date('Y-m-d H:i:s'),
                'updated_at'    =>  date('Y-m-d H:i:s')
            )
        );
        DB::table('categories')->insert(
            array(
                "name"=>'{"sr":"2 Zvezdice","en":"2 Stars"}',
                'created_at'    =>  date('Y-m-d H:i:s'),
                'updated_at'    =>  date('Y-m-d H:i:s')
            )
        );
        DB::table('categories')->insert(
            array(
                "name"=>'{"sr":"3 Zvezdice","en":"3 Stars"}',
                'created_at'    =>  date('Y-m-d H:i:s'),
                'updated_at'    =>  date('Y-m-d H:i:s')
            )
        );
        DB::table('categories')->insert(
            array(
                "name"=>'{"sr":"4 Zvezdice","en":"4 Stars"}',
                'created_at'    =>  date('Y-m-d H:i:s'),
                'updated_at'    =>  date('Y-m-d H:i:s')
            )
        );
        DB::table('categories')->insert(
            array(
                "name"=>'{"sr":"5 Zvezdica","en":"5 Stars"}',
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
        Schema::drop('categories');
    }
}
