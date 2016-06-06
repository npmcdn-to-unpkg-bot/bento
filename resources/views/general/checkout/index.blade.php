@extends(Agent::isMobile() ? 'general.layout.mobile' : 'general.layout.desktop')

@section('content')
	<div class="container">
		<div class="title">
			<span class="title__text">Оформление заказа</span>
		</div>
		<form action="{{url('checkout')}}" method="POST">
			{{csrf_field()}}
			<div class="offset_bottom_30">
				<div class="offset_bottom_10"><b>Телефон</b></div>
				<input type="text" name="phone" class="input" value="{{auth()->user()->phone}}">
			</div>
			<div class="offset_bottom_30">
				<div class="offset_bottom_10"><b>Адрес</b></div>
				@foreach (auth()->user()->places as $i => $place)
				<div class="offset_bottom_10">
					<label><input type="radio" name="place" @if($i==0) checked @endif value="{{$place->text}}"> {{$place->name}} {{$place->text}}</label>
				</div>
				@endforeach

				<div class="offset_bottom_10">
					<label><input id="new_place" type="radio" name="place" value=""> <input type="text" class="input" name="new_place" placeholder="Другой адрес"></label>
				</div>

				<script>
				document.addEventListener('DOMContentLoaded', function(){
					$('[name="new_place"]').on('change',function(){
						$('#new_place')
							.val( $(this).val() )
							.click();
					});
				})
				</script>
			</div>
			<div class="offset_bottom_30">
				<div class="offset_bottom_10"><b>Комментарии к заказу</b></div>
				<textarea name="comment" class="input input_textarea" placeholder="Комментарий к заказу: удобное время доставки, нужна ли сдача."></textarea>
			</div>
			<div class="offset_bottom_30">
				<button class="button button_red">ОФОРМИТЬ</button>
			</div>
		</form>
	</div>
@endsection