<div class="shoping-cart">
	<div class="floating-shoping-cart__top">
		@if (!$user)
			<div class="shoping-cart__user">
				<img src="{{url('img/login-icon.png')}}" alt="" class="shoping-cart__icon">
				<a href="#login" class="fancybox shoping-cart__login">ВХОД</a>
				<a href="#register" class="fancybox shoping-cart__register">РЕГИСТРАЦИЯ</a>
			</div>
		@endif
		<div class="shoping-cart__title">
			<img src="{{url('img/cart.png')}}" alt="" class="shoping-cart__icon">
			ВАША КОРЗИНА
		</div>
	</div>
	<div class="floating-shoping-cart__middle">
	@if ($cart)
		<div class="shoping-cart__items">
			<table>
				@foreach ($cart->products as $product)
				<tr class="shoping-cart__item">
					<td class="shoping-cart__item-count">
					<form action="{{url('cart/update')}}" class="ajax-update-cart-item">
						{!!csrf_field()!!}
						<input type="hidden" name="id" value="{{$product->id}}">
						<input type="number" class="number number_small" name="quantity" value="{{$product->pivot->quantity}}">
					</form>
					</td>
					<td class="shoping-cart__item-name">{{$product->name}}</td>
					<td class="shoping-cart__item-price">{{$product->new_price()*$product->pivot->quantity}}грн</td>
					<td><a href="{{url('cart/delete/'.$product->id)}}" data-id="{{$product->id}}" class="button_cart_delete shoping-cart__item-remove"></a></td>
				</tr>
				@endforeach
				@if ($cart->gift() && $product = $cart->gift()->product)
					<tr class="shoping-cart__item">
						<td class="shoping-cart__item-count">1</td>
						<td class="shoping-cart__item-name">{{$product->name}}</td>
						<td class="shoping-cart__item-price">0грн</td>
						<td></td>
					</tr>
				@endif
			</table>
			@if ($product = $cart->deleted_product())
				<div style="color: red">Вы удалили {{$product->name}} <a href="{{url('cart/add/'.$product->id)}}" class="button_cart_add">ВОССТАНОВИТЬ</a></div>
			@endif
		</div>
	@endif
	</div>
	<div class="floating-shoping-cart__bottom">
	@if($cart)
		<table class="cart-total">
			<tr>
				<td class="cart-total__label">Сумма</td>
				<td class="cart-total__value">{{$cart->sum()}} грн</td>
			</tr>
			<tr>
				<td class="cart-total__label">Доставка</td>
				<td class="cart-total__value">{{$cart->delivery()}} грн</td>
			</tr>
			<tr class="cart-total__result">
				<td class="cart-total__label">ИТОГО</td>
				<td class="cart-total__value">{{$cart->total()}} грн</td>
			</tr>						
		</table>
			<a href="{{url('checkout')}}" class="button button_100 offset_bottom_10 offset_top_10 button_red button_small">ОФОРМИТЬ ЗАКАЗ</a>
			
		@if(!$user)
			<a href="#checkout" class="fancybox button button_100 offset_bottom_10 offset_top_10 button_red button_small">ОФОРМИТЬ В 1 КЛИК</a>
		@endif

		@if ($cart->next_gift())
			<div style="color: red">Купите еще на {{$cart->next_gift()->start - $cart->sum()}}грн. и получите {{$cart->next_gift()->product->name}} в подарок!!!</div>
		@endif
	@endif
	</div>
</div>