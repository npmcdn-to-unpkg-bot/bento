@if($user = $cart->user)
<div class="row">
	<div class="col-md-4">
		<table class="table table-striped">
			<tr>
				<td>Имя</td><td>{{$user->first_name}}</td>
			</tr>
			<tr>
				<td>Фамилия</td><td>{{$user->last_name}}</td>
			</tr>
			<tr>
				<td>Телефон</td><td>{{$user->phone}}</td>
			</tr>
			<tr>
				<td>Адрес</td><td>{{$user->place}}</td>
			</tr>
		</table>
	</div>
</div>
@endif
<table class="table table-striped">
	<tr>
		<th class="row-header">Название</th>
		<th class="row-header">Цена без скидок</th>
		<th class="row-header">Количество</th>
	</tr>
	@foreach($cart->products as $product)
	<tr>
		<td>{{$product->name}}</td>
		<td>{{$product->price}} грн.</td>
		<td>{{$product->pivot->quantity}}</td>
	</tr>
	@endforeach
	@if( $cart->gift() && $product = $cart->gift()->product )
	<tr>
		<td>{{$product->name}}</td>
		<td>0 грн.</td>
		<td>1</td>
	</tr>
	@endif
</table>
