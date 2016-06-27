<form action="/menu/{{$category->slug}}#filter" id="filter" class="offset_top_30">
	@foreach($ingredients as $i => $ingredient)
	@if ($i%6==0)<div class="row">@endif
		<div class="row__col-2 offset_bottom_10">
			<label class="checkbox">
				<input type="checkbox" value="{{$ingredient->id}}" @if ( in_array($ingredient->id, $ingredients_checked ) ) checked @endif >
				<span class="checkbox__mark"></span>
				{{$ingredient->name}}
			</label>
		</div>
	@if ( ($i+1)%6==0 || $ingredients->last()==$ingredient ) </div> @endif
	@endforeach
	<input type="hidden" name="ingredients">

	<div class="row offset_top_30 offset_bottom_30">
		<div class="row__col-6">
			<div class="row offset_bottom_10">
				<div class="row__col-3">
					<input type="number" id="price_min" class="input input_100" name="min">
				</div>
				<div class="row__col-offset-6 row__col-3">
					<input type="number" id="price_max" class="input input_100" name="max">
				</div>
			</div>
			<div id="price_filter"></div>
		</div>
	</div>

	<button type="submit" class="button button_red button_small">ПРИМЕНИТЬ</button>
	<a href="/menu/{{$category->slug}}#filter" class="button button_small">ОЧИСТИТЬ ФИЛЬТР</a>
</form>

@push('styles')
	<link rel="stylesheet" href="{{url('bower/nouislider/distribute/nouislider.min.css')}}">
@endpush

@push('scripts')
	<script src="{{url('bower/nouislider/distribute/nouislider.min.js')}}"></script>
	<script>
		var priceFilter = document.getElementById('price_filter')
		var priceMin = document.getElementById('price_min')
		var priceMax = document.getElementById('price_max')

		noUiSlider.create(priceFilter, {
			start: [{{$min}}, {{$max}}],
			connect: true,
			range: {
				'min': {{$min_possible}},
				'max': {{$max_possible}}
			}
		})

		priceFilter.noUiSlider.on('update',function(values,handle){
			var value = Math.round( values[handle] )
			if (handle)
				priceMax.value = value
			else
				priceMin.value = value
		})

		priceMin.addEventListener('change', function(){
			priceFilter.noUiSlider.set([this.value,null])
		})

		priceMax.addEventListener('change', function(){
			priceFilter.noUiSlider.set([null,this.value])
		})


		$('#filter').on('change',function (event) {
			$(this).find('[name=ingredients]').val(
				$(this)
					.find('input:checked')
					.map(function (){ return this.value })
					.get()
					.join(',')
			)
		})
	</script>
@endpush