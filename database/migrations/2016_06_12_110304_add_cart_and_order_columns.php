<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCartAndOrderColumns extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('carts', function($table){
            $table->integer('persons');
            $table->string('time');
        });
        Schema::table('orders', function($table){
            $table->integer('persons');
            $table->string('time');
            $table->dropColumn('place_id');
            $table->string('place');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('carts', function($table){
            $table->dropColumn('persons');
            $table->dropColumn('time');
        });
        Schema::table('orders', function($table){
            $table->dropColumn('persons');
            $table->dropColumn('time');
            $table->dropColumn('place');
            $table->integer('place_id');
        });
    }
}
