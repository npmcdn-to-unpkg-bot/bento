<table class="products-table shoping-cart-table">
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
		<td><input class="ajax-send-input input input_round"  data-id="{{$product->id}}" data-action="{{url('cart/update')}}" style="width: 80px;" type="number" value="{{$product->pivot->quantity}}"></td>
		<td><span class="input input_round">{{$product->price}}</span></td>
		<td><span class="input input_round">{{$product->pivot->quantity*$product->price}}</span></td>
		<td><a href="{{url('cart/delete')}}" data-id="{{$product->id}}" class="button_cart_delete products-table__remove"></a></td>
	</tr>
	@endforeach
</table>