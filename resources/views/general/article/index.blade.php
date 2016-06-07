@extends(Agent::isMobile() ? 'general.layout.mobile' : 'general.layout.desktop')

@section('content')
<div class="container">
	<div class="row">
		<div class="row__col-8 row__col-mob-12">
			@include('general.article.list')
		</div>
		<div class="row__col-4 row__col-mob-12">
			@include('general.article.block', $sidebar)
		</div>
	</div>
</div>
@endsection