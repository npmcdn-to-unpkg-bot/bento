@extends(Agent::isMobile() ? 'general.layout.mobile' : 'general.layout.desktop')

@section('content')
<div class="container container_fix">
	<div class="title">
		<span class="title__text">ВАША КОРЗИНА</span>
	</div>
	@include('general.cart.table')
	<div class="row offset_top_60">
		<div class="row__col-8 row__col-offset-2">
			<form action="{{url('checkout')}}" method="POST">
				{{csrf_field()}}

				@if ($user)
					@include('general.checkout.authorized')
				@else
					@include('general.checkout.registration')
				@endif

				<textarea name="comment" class="input input_textarea input_100 offset_bottom_30" placeholder="Примечания: приготовить сдачу..."></textarea>

				@include('general.checkout.payment')

				<div class="offset_bottom_30 text_center">
					<button class="button button_red button_small">ОФОРМИТЬ ЗАКАЗ</button>
				</div>

			</form>
		</div>
	</div>
</div>
@endsection