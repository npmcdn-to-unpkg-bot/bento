<div class="title">
	<div class="title__text">{{$title}}</div>
</div>
@foreach ($articles as $article)
<div class="article">
	<img src="/width/264?image={{$article->image}}" alt="{{$article->title}}" class="article__image">
	<div class="article__post-date">{{$article->created_at->day}} {{trans('month.'.$article->created_at->month)}}</div>
	<div class="article__title">{{$article->title}}</div>
	<div class="article__text">{{$article->entry}}</div>
	<a href="{{$article->url()}}" class="article__more button button_red">ЧИТАТЬ</a>
</div>
@endforeach
@include('general.pagenav', [
	'items' => $articles
])