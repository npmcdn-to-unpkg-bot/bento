<div class="shoping-cart-table">
	@if ($cart && $product = $cart->deleted_product())
		<div class="offset_bottom_10 error">Вы удалили {{$product->name}} <a href="{{url('cart/add/'.$product->id)}}" class="button_cart_add">ВОССТАНОВИТЬ</a></div>
	@endif
	<table class="products-table">
		<tr>
			<th>Продукт</th>
			<th>Наименование</th>
			<th>Количество</th>
			<th>Цена</th>
			<th>Общая стоимость</th>
			<th>Удалить из списка</th>
		</tr>
		@foreach ($cart->products as $product)
		<tr>
			<td><img src="/width/120?image={{$product->image}}" alt=""></td>
			<td>
				<b>{{$product->name}}</b>
				<div class="products-table__ingredients">{{$product->ingredients->implode('name', ', ')}}</div>
			</td>
			<td>
				<form action="{{url('cart/update')}}" class="ajax-update-cart-item">
					{!!csrf_field()!!}
					<input type="hidden" name="id" value="{{$product->id}}">
					<input type="number" class="input input_round" style="width: 80px" name="quantity" value="{{$product->pivot->quantity}}">
				</form>
			</td>
			<td><span class="input input_round">{{$product->price}} грн.</span></td>
			<td><span class="input input_round">{{$product->pivot->quantity*$product->price}} грн.</span></td>
			<td><a href="{{url('cart/delete/'.$product->id)}}" data-id="{{$product->id}}" class="button_cart_delete products-table__remove"></a></td>
		</tr>
		@endforeach
		@if ($cart->gift() && $product = $cart->gift()->product)
		<tr>
			<td><img src="/width/120?image={{$product->image}}" alt=""></td>
			<td>
				<b>{{$product->name}}</b>
				<div class="products-table__ingredients">{{$product->ingredients->implode('name', ', ')}}</div>
			</td>
			<td><span class="input input_round">1</span></td>
			<td><span class="input input_round">0 грн.</span></td>
			<td><span class="input input_round">0 грн.</span></td>
			<td></td>
		</tr>
		@endif
	</table>
	<div class="row offset_top_30">
		<div class="row__col-right">
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
		</div>
	</div>
</div>