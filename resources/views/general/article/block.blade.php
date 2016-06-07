<div class="title">
	<div class="title__text">{{$title}}</div>
</div>
<div class="l-articles">
	<div class="l-articles__title">Наиболее популярные</div>
	@foreach($articles as $article)
	<div class="l-articles__item">
		<img src="/fit/85/85?image={{$article->image}}" alt="" class="l-articles__image">
		<div class="l-articles__text">{{$article->title}}</div>
		<a href="{{$article->url()}}" class="l-articles__more">Читать</a>
	</div>
	@endforeach
	<a href="{{$url}}" class="l-articles__all">Смотреть все новости</a>
</div>