<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBlogArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blog_articles', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('image');
            $table->string('title');
            $table->string('slug');
            $table->string('meta_title');
            $table->text('meta_description');
            $table->text('entry');
            $table->longtext('content');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('blog_articles');
    }
}
