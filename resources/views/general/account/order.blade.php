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
	</table>
	<div class="row">
		<div class="row__col-9"></div>
		<div class="row__col-3">
			@if ($order->payed=='Ожидает оплаты')
				{!!$payment->cnb_form([
	                'version'        => 3,
	                'action'         => 'pay',
	                'amount'         => $order->sum(),
	                'currency'       => 'UAH',
	                'sandbox'        => '1',
	                'description'    => $order->products->implode('name',', '),
	                'order_id'       => $order->id,
	                'result_url'     => url('account'),
	            ])!!}
			@endif
		</div>
	</div>
</div>