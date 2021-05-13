<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAccommodationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accommodation', function(Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('city_id')->unsigned()->index();
            $table->foreign("city_id")
                ->references('id')
                ->on('city')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->integer('user_id')->unsigned()->index();
            $table->foreign("user_id")
                ->references('id')
                ->on('users')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->integer('category_id')->unsigned()->index();
            $table->foreign("category_id")
                ->references('id')
                ->on('categories')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->integer('type_id')->unsigned()->index();
            $table->foreign("type_id")
                ->references('id')
                ->on('types')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->longText('description')->nullable();
            $table->integer('capacity');
            $table->string('deposit')->nullable();
            $table->string('longitude')->nullable();
            $table->string('latitude')->nullable();
            $table->string('website')->nullable();
            $table->string('address')->nullable();
            $table->string('youtube_link')->nullable();
            $table->integer('priority')->nullable();
            $table->integer('premium')->nullable();
            $table->integer('status')->nullable();
            $table->integer('views')->nullable();
            $table->softDeletes();
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
        Schema::drop('accommodation');
    }
}
