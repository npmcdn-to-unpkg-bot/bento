@if ($products) 
@foreach ($products as $product)
	<div class="container__col-4">
		<table class="product">
			<tr>
				<td class="product__images-wrap">
					<a href="{{url('menu/'.$product->id)}}">
						<img src="/fit/210/140?image={{$product->image}}" alt="" class="product__image">
						@if ($product->left_label) <img src="{{url($product->left_label->image)}}" alt="" class="product__left-label"> @endif
						@if ($product->right_label) <img src="{{url($product->right_label->image)}}" alt="" class="product__right-label"> @endif
					</a>
				</td>
			</tr>
			<tr>
				<td class="product__title-wrap">
					<a href="{{url('menu/'.$product->id)}}" class="product__title">{{$product->name}}</a>
				</td>
			</tr>
			<tr>
				<td class="product__ingredients-wrap">
					<a href="{{url('menu/'.$product->id)}}" class="product__ingredients">{{$product->ingredients->implode('name',', ')}}</a>
				</td>
			</tr>
			<tr>
				<td class="product__price-wrap">
					<span class="product__price">{{$product->price}}
						<span class="product__curency">грн</span>
					</span>
				</td>
			</tr>
			<tr>
				<td class="product__diet">
					@if ($product->ingredients)
					<span class="product__kcal">{{ $product->kcal()/100*$product->weight() }}</span>
					<span class="product__gramm">{{ $product->weight() }}</span>
					@endif
				</td>
			</tr>
			<tr>
				<td>
					<a href="" class="product__compare button button_small"></a>
					<a href="" class="product__wish button button_small"></a>
					<a href="{{url('cart/add')}}" data-id="{{$product->id}}" data-token="{{csrf_token()}}" class="ajax-send-id product__buy button button_small">В КОРЗИНУ</a>
				</td>
			</tr>
		</table>		
	</div>
@endforeach
@endif