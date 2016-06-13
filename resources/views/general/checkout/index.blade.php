@extends(Agent::isMobile() ? 'general.layout.mobile' : 'general.layout.desktop')

@section('content')
<div class="container container_fix">
	<div class="title">
		<span class="title__text">ВАША КОРЗИНА</span>
	</div>
	@include('general.cart.table')
	<div class="row offset_top_60">
		<div class="row__col-8 row__col-offset-2">
			@if ($user)
				@include('general.checkout.authorized')
			@else
				<div class="offset_bottom_30 text_center">
					<a href="#checkout" class="fancybox button button_red button_small">ОФОРМИТЬ В 1 КЛИК</a>
				</div>
				@include('general.checkout.registration')
			@endif
		</div>
	</div>
</div>
@endsection