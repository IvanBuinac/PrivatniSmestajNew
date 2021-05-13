<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCharacteristicsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('characteristics', function(Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('chack')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });

        DB::table('characteristics')->insert(
            array(
                "name"=>'{"sr":"Voda 24h","en":"Water 24h"}',
                "chack"=>1,
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
        Schema::drop('characteristics');
    }
}
