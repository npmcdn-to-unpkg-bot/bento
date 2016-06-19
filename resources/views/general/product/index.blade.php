@extends(Agent::isMobile() ? 'general.layout.mobile' : 'general.layout.desktop')

@section('title') {{ $category->name }} @endsection
@section('meta-title') {{$category->meta_title ? $category->meta_title : $category->name }} @endsection
@section('meta-desctiption') {{$category->meta_description }} @endsection

@section('content')
	<div class="container">
		@include('general.product.filter')
		<div class="title">
			<span class="title__text">{{$category->name}}</span>
		</div>
		@include('general.product.list')
	</div>
@endsection