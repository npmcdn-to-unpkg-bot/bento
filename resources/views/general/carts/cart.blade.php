<form>
	@if (!auth()->user())
	<div class="floating-shoping-cart__user">
		<img src="{{url('img/login-icon.png')}}" alt="" class="floating-shoping-cart__icon">
		<a href="#login" class="fancybox floating-shoping-cart__login">ВХОД</a>
		<a href="#register" class="fancybox floating-shoping-cart__register">РЕГИСТРАЦИЯ</a>
	</div>
	@endif
	<div class="floating-shoping-cart__title">
		<img src="{{url('img/cart.png')}}" alt="" class="floating-shoping-cart__icon">
		ВАША КОРЗИНА
	</div>
	@if ($cart = App\Models\Cart::cart())
	<table class="floating-shoping-cart__items">
		@foreach ($cart->products as $product)
		<tr class="floating-shoping-cart__item">
			<td class="floating-shoping-cart__item-count">
				<input type="number" data-action="{{url('cart/update')}}" data-id="{{$product->id}}" data-token="{{csrf_token()}}" class="ajax-send-input number number_small" name="" value="{{$product->pivot->quantity}}">
			</td>
			<td class="floating-shoping-cart__item-name">{{$product->name}}</td>
			<td class="floating-shoping-cart__item-price">{{$product->price}}грн</td>
			<td><a href="{{url('cart/delete')}}" data-id="{{$product->id}}" data-token="{{csrf_token()}}" class="ajax-send-id floating-shoping-cart__item-remove"></a></td>
		</tr>
		@endforeach
	</table>
	<table class="cart-total">
		<tr>
			<td class="cart-total__label">Сумма</td>
			<td class="cart-total__value">{{$cart->sum()}} грн</td>
		</tr>
		<tr>
			<td class="cart-total__label">Скидка</td>
			<td class="cart-total__value">-20 грн</td>
		</tr>
		<tr>
			<td class="cart-total__label">Доставка</td>
			<td class="cart-total__value">25 грн</td>
		</tr>
		<tr class="cart-total__result">
			<td class="cart-total__label">ИТОГО</td>
			<td class="cart-total__value">{{$cart->sum() - 20 + 25}} грн</td>
		</tr>						
	</table>
	@endif
	<a href="" class="floating-shoping-cart__checkout button button_red button_small">ОФОРМИТЬ ЗАКАЗ</a>
</form>