<?php

namespace App\Models\Blog;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{

    protected $table = 'blog_articles';

    public function url () {
    	return url('blog/'.$this->slug);
    }

    public function allUrl () {
    	return url('blog');
    }
}
