<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSlidesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('slides', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();

            $table->string('image');

            $table->string('title');
            $table->string('title_effect')->nullable();
            $table->integer('title_time');

            $table->string('text');
            $table->string('text_effect')->nullable();
            $table->integer('text_time');

            $table->string('button');
            $table->string('button_effect')->nullable();
            $table->integer('button_time');

            $table->string('href');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('slides');
    }
}
