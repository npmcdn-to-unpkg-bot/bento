@extends('general.desktop.layout')

@section('content')
<div class="container">
	<div class="container__main">
		<div class="title">
			<div class="title__text">{{$title}}</div>
		</div>
		@include('general.article.list')
		<div class="page-nav">
			<a href="" class="page-nav__item page-nav__item_prev"></a>
			<span href="" class="page-nav__item page-nav__item_active">1</span>
			<a href="" class="page-nav__item">2</a>
			<a href="" class="page-nav__item">3</a>
			<a href="" class="page-nav__item page-nav__item_next"></a>
		</div>
	</div>
	<div class="container__side">
		<div class="title">
			<div class="title__text">{{$sidebar_title}}</div>
		</div>
		@include('general.article.block',[
			'articles'=>App\Models\Blog\Article::orderBy('created_at')->take(3)->get(),
			'title'=>'БЛОГ',
			'view_all_text' => 'Смотреть все новости',
			'view_all_href' => url('blog')
		])
	</div>
</div>
@endsection