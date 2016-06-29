<a 
	href="{{url('cart/add/'.$product->id)}}"
	data-id="{{$product->id}}"
	class="button_cart_add @if(Cart::has($product)) button_cart_add_active @endif product__buy button button_small"
>
В КОРЗИНУ
</a>

<form action="{{url('cart/update')}}" class="ajax-update-cart-item product__quantity button button_red button_small">
	<input type="hidden" name="id" value="{{$product->id}}">
	<input 
		type="number"
		class="number number_small"
		data-id="{{$product->id}}"
		name="quantity"
		autocomplete="off"
		value="{{$cart->products()->find($product->id) ? $cart->products()->find($product->id)->pivot->quantity : 1}}"
	>
</form>
