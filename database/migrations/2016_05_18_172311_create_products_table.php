<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('image');
            $table->string('name');
            $table->string('slug');
            $table->string('meta_title');
            $table->text('meta_description');
            $table->text('description');
            $table->integer('price');
            $table->integer('order');
            $table->integer('left_label_id')->index()->nullable();
            $table->integer('right_label_id')->index()->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('products');
    }
}
