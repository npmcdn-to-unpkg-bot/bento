<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnsToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users',function($table){
            $table->string('first_name');
            $table->string('last_name');
            $table->string('trafic_source');
            $table->string('bento_card');
            $table->date('birth_day');
            $table->dropColumn('name');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users',function($table){
            $table->dropColumn('first_name');
            $table->dropColumn('last_name');
            $table->dropColumn('trafic_source');
            $table->dropColumn('bento_card');
            $table->dropColumn('birth_day');
            $table->string('name');
        });
    }
}
