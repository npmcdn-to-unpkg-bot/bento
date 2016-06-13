@extends(Agent::isMobile() ? 'general.layout.mobile' : 'general.layout.desktop')

@section('title') {{ $article->title }} @endsection
@section('meta-title') {{$article->meta_title ? $article->meta_title : $article->title }} @endsection
@section('meta-desctiption') {{$article->meta_description ? $article->meta_description : $article->entry }} @endsection

@section('content')
<div class="container">
	<div class="title">
		<div class="title__text">{{$article->title}}</div>
	</div>
	<div class="article">
		@if($article->image)<img src="/width/264?image={{$article->image}}" alt="{{$article->title}}" class="article__image">@endif
		<div class="article__post-date">{{$article->created_at->day}} {{trans('month.'.$article->created_at->month)}}</div>
		<br>
		<div>{!!$article->content!!}</div>
		<div class="text_right">Рассказать друзьям: <div class="share-buttons">@include('general.share')</div></div>
	</div>
</div>
@endsection