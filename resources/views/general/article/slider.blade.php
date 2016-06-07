<div class="title">
	<div class="title__text">{{$title}}</div>
</div>
<div class="articles-slider">
	<ul class="slides">
		@foreach($articles as $article)
		<li>
			<div class="article">
				<img src="/width/264?image={{$article->image}}" alt="{{$article->title}}" class="article__image">
				<div class="article__post-date">{{$article->created_at->day}} {{trans('month.'.$article->created_at->month)}}</div>
				<div class="article__title">{{$article->title}}</div>
				<div class="article__text">{{$article->entry}}</div>
				<a href="" class="article__more button button_red">ЧИТАТЬ</a>
			</div>
		</li>
		@endforeach
	</ul>
</div>