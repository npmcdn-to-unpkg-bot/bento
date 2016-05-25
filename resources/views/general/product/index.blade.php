@extends('general.desktop.layout')

@section('content')
	<div class="container">
		<div class="title">
			<span class="title__text">{{$category->name}}</span>
		</div>
		@include('general.product.list')
	</div>
@endsection