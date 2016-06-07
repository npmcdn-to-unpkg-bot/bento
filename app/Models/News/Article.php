<?php

namespace App\Models\News;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $table = 'news_articles';

    public function url () {
    	return url('news/'.$this->slug);
    }

    public function allUrl () {
    	return url('blog');
    }
    
}
