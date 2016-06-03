<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateComparelistsTable extends Migration
{
     /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comparelists', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('user_id')->index();
            $table->string('hash')->index();
        });

        Schema::create('comparelist_product', function (Blueprint $table) {
            $table->integer('comparelist_id')->index();
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
        Schema::drop('comparelists');
        Schema::drop('comparelist_product');
    }
}
