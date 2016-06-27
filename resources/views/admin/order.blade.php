<div class="row">
	<div class="col-md-4">
		<table class="table table-striped">
			<tr>
				<td>Имя</td><td>{{$order->first_name}}</td>
			</tr>
			@if($user = $order->user)
			<tr>
				<td>Фамилия</td><td>{{$user->last_name}}</td>
			</tr>
			@endif
			<tr>
				<td>Телефон</td><td>{{$order->phone}}</td>
			</tr>
			<tr>
				<td>Адрес</td><td>{{$order->place}}</td>
			</tr>
			<tr>
				<td>Сумма</td><td>{{$order->sum()}} грн.</td>
			</tr>
			<tr>
				<td>Доставка</td><td>{{$order->delivery()}} грн.</td>
			</tr>
			<tr>
				<td>Итог</td><td>{{$order->total()}} грн.</td>
			</tr>
		</table>
	</div>
</div>
<table class="table table-striped">
	<tr>
		<th class="row-header">Название</th>
		<th class="row-header">Цена со скидками</th>
		<th class="row-header">Количество</th>
	</tr>
	@foreach($order->products as $product)
	<tr>
		<td>{{$product->name}}</td>
		<td>{{$product->pivot->price}} грн.</td>
		<td>{{$product->pivot->quantity}}</td>
	</tr>
	@endforeach
	@if( $order->gift() && $product = $order->gift()->product )
	<tr>
		<td>{{$product->name}}</td>
		<td>0 грн.</td>
		<td>1</td>
	</tr>
	@endif
</table>
