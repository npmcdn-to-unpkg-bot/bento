<?php

namespace App\Http\Controllers\General;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use \App\Models\News\Article as News;
use \App\Models\Blog\Article as Blog;

class BlogController extends Controller
{
    public function index($slug = false)
    {
        if (!$slug) {
            return view('general.article.index',[
                'title' => 'БЛОГ',
                'articles' => Blog::orderBy('created_at')->paginate(3),
            ]);
        }else{
            return $this->show($slug);
        }
    }

    public function show($slug)
    {
        return view('general.article.show',[
            'article' => Blog::where('slug', $slug)->first(),
        ]);
    }

}
