<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->softDeletes();
            $table->string('name');
            $table->time('start');
            $table->time('end');
            $table->integer('order');
            $table->boolean('stackable');
            $table->integer('value');
        });
        Schema::create('sale_user', function (Blueprint $table) {
            $table->integer('sale_id')->index();
            $table->integer('user_id')->index();
        });
        Schema::create('product_sale', function (Blueprint $table) {
            $table->integer('sale_id')->index();
            $table->integer('product_id')->index();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('sales');
        Schema::drop('sale_user');
        Schema::drop('product_sale');
    }
}
