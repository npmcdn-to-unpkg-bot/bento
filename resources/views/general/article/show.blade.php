@extends(Agent::isMobile() ? 'general.layout.mobile' : 'general.layout.desktop')

@section('title') {{ $article->title }} @endsection
@section('meta-title') {{$article->meta_title ? $article->meta_title : $article->title }} @endsection
@section('meta-desctiption') {{$article->meta_description ? $article->meta_description : $article->entry }} @endsection

@section('content')
<div class="container">
	<div class="row">
		<div class="row__col-8 row__col-mob-12">
			<div class="title">
				<div class="title__text">{{$article->title}}</div>
			</div>
			<div class="article">
				<img src="/width/264?image={{$article->image}}" alt="{{$article->title}}" class="article__image">
				<div class="article__post-date">{{$article->created_at->day}} {{trans('month.'.$article->created_at->month)}}</div>
				<br>
				<div>{!!$article->content!!}</div>
				<div class="text_right">Рассказать друзьям: <div class="share-buttons">@include('general.share')</div></div>
			</div>
		</div>
		<div class="row__col-4 row__col-mob-12">
			@include('general.article.block', $sidebar)
		</div>
	</div>
</div>
@endsection