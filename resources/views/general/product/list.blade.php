@if ($products) 
	<?php $columns = Agent::isMobile() ? 2 : 3 ?>
	@foreach ($products as $i => $product)
		@if ($i%$columns==0) <div class="row"> @endif
		<div class="row__col-4 row__col-mob-6">
			<table class="product">
				<tr>
					<td class="product__images-wrap">
						<a href="{{$product->url()}}">
							<img src="/fit/210/140?image={{$product->image}}" alt="" class="product__image">
							@if ($product->left_label) <img src="{{url($product->left_label->image)}}" alt="" class="product__left-label"> @endif
							@if ($product->right_label) <img src="{{url($product->right_label->image)}}" alt="" class="product__right-label"> @endif
						</a>
					</td>
				</tr>
				<tr>
					<td class="product__title-wrap">
						<a href="{{$product->url()}}" class="product__title">{{$product->name}}</a>
					</td>
				</tr>
				<tr>
					<td class="product__ingredients-wrap">
						<a href="{{$product->url()}}" class="product__ingredients">{{$product->ingredients->implode('name',', ')}}</a>
					</td>
				</tr>
				<tr>
					<td class="product__price-wrap">
						<span class="product__price">
						@if($product->old_price)<del>{{$product->old_price}} <span class="product__curency">грн</span></del> @endif
						{{$product->new_price()}}
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
						@include('general.product.buttons')
					</td>
				</tr>
			</table>		
		</div>
		@if(($i+1)%$columns==0||$products->last()==$product)</div>@endif
	@endforeach
@endif