<a 
	href="{{url('cart/add/'.$product->id)}}"
	data-id="{{$product->id}}"
	class="button_cart_add @if(Cart::has($product)) button_red @endif product__buy button button_small"
>В КОРЗИНУ</a>