@extends(Agent::isMobile() ? 'general.layout.mobile' : 'general.layout.desktop')

@section('title') Поиск @endsection
@section('meta-title') Поиск @endsection

@section('content')
	<div class="container">
		<div class="title">
			<span class="title__text">Поиск: {{Request::get('q')}}</span>
		</div>
		@include('general.product.list')
	</div>
@endsection