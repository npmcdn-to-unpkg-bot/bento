<div class="offset_bottom_60">
	<div class="row offset_bottom_10">
		<div class="row__col-6">
			<span class="button button_small button_red">{{$order->status}}</span>
		</div>
		<div class="row__col-6 text_right">
			<i class="fa fa-calendar"></i> Заказ от {{$order->created_at->format('d.m.Y')}} 
			<i class="fa fa-clock-o"></i> {{$order->created_at->format('H:i')}},
			№ заказа #{{$order->id}}
		</div>
	</div>
	<table class="products-table offset_bottom_30">
		<tr>
			<th>Продукт</th>
			<th>Наименование</th>
			<th>Цена</th>
			<th>Количество</th>
			<th>Итог</th>
		</tr>
		@foreach ($order->products as $product)
		 <tr>
		 	<td><img src="/width/120?image={{$product->image}}" alt=""></td>
		 	<td>
		 		<b>{{$product->name}}</b>
		 		<div class="products-table__ingredients">{{$product->ingredients->implode('name',', ')}}</div>
		 	</td>
		 	<td><span class="input input_round">{{$product->price}}</span></td>
		 	<td><span class="input input_round">{{$product->pivot->quantity}}</span></td>
		 	<td><span class="input input_round">{{$product->pivot->quantity*$product->price}}</span></td>
		 </tr>
		@endforeach
		@if ($order->gift() && $product = $order->gift()->product)
		 <tr>
		 	<td><img src="/width/120?image={{$product->image}}" alt=""></td>
		 	<td>
		 		<b>{{$product->name}}</b>
		 		<div class="products-table__ingredients">{{$product->ingredients->implode('name',', ')}}</div>
		 	</td>
		 	<td><span class="input input_round">0 грн.</span></td>
		 	<td><span class="input input_round">1</span></td>
		 	<td><span class="input input_round">0 грн.</span></td>
		 </tr>
		@endif
	</table>
	<div class="row offset_top_30">
		<div class="row__col-right">
			<table class="cart-total">
				<tr>
					<td class="cart-total__label">Сумма</td>
					<td class="cart-total__value">{{$order->sum()}} грн</td>
				</tr>
				<tr>
					<td class="cart-total__label">Доставка</td>
					<td class="cart-total__value">{{$order->delivery()}} грн</td>
				</tr>
				<tr class="cart-total__result">
					<td class="cart-total__label">К ОПЛАТЕ</td>
					<td class="cart-total__value">{{$order->total()}} грн</td>
				</tr>						
			</table>
			@if ($order->payed=='Ожидает оплаты')
				{!!$payment->cnb_form([
	                'version'        => 3,
	                'action'         => 'pay',
	                'amount'         => $order->total(),
	                'currency'       => 'UAH',
	                'sandbox'        => '1',
	                'description'    => $order->products->implode('name',', '),
	                'order_id'       => $order->id,
	                'result_url'     => url('account'),
	                'server_url'     => url('pay')
	            ])!!}
			@endif
		</div>
	</div>
</div>