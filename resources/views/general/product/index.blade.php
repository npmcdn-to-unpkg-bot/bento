@extends(Agent::isMobile() ? 'general.layout.mobile' : 'general.layout.desktop')

@section('title') {{ $category->name }} @endsection
@section('meta-title') {{$category->meta_title ? $category->meta_title : $category->name }} @endsection
@section('meta-desctiption') {{$category->meta_description }} @endsection

@section('content')
	<div class="container">
		<form action="/menu/{{$category->slug}}#filter" id="filter" class="offset_top_30">
			@foreach($ingredients as $i => $ingredient)
			@if ($i%6==0)<div class="row">@endif
				<div class="row__col-2 offset_bottom_10">
					<label>
						<input type="checkbox" value="{{$ingredient->id}}" @if ( in_array($ingredient->id, $ingredients_checked ) ) checked @endif >
						{{$ingredient->name}}
					</label>
				</div>
			@if ( ($i+1)%6==0 || $ingredients->last()==$ingredient ) </div> @endif
			@endforeach
			<input type="hidden" name="ingredients">
			<script>
				document
					.getElementById('filter')
					.addEventListener('change', refreshListOfIngredients);
				function refreshListOfIngredients(event) {
					$(this).find('[name=ingredients]').val(
						$(this)
							.find('input:checked')
							.map(function (){ return this.value })
							.get()
							.join(',')
					)
				}
			</script>
			<button type="submit" class="button button_red button_small">ПРИМЕНИТЬ</button>
			<a href="/menu/{{$category->slug}}#filter" class="button button_small">ОЧИСТИТЬ ФИЛЬТР</a>
		</form>
		<div class="title">
			<span class="title__text">{{$category->name}}</span>
		</div>
		@include('general.product.list')
	</div>
@endsection