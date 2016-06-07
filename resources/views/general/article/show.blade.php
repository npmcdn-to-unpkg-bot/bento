@extends(Agent::isMobile() ? 'general.layout.mobile' : 'general.layout.desktop')

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
			</div>
		</div>
		<div class="row__col-4 row__col-mob-12">
			@include('general.article.block', $sidebar)
		</div>
	</div>
</div>
@endsection