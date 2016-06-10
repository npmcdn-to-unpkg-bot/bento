<div id="comparelist" class="modal">
	<div class="modal__title">СРАВНЕНИЕ ТОВАРОВ</div>
	@if ($comparelist = App\Models\Comparelist::get())
		@foreach($comparelist->products as $i => $product)
			@if ($i%2==0) <div class="row"> @endif
			<div class="row__col-6">
				<div class="compare-product">
					<img src="/width/100/?image={{$product->image}}" alt="" class="compare-product__image">
					<div class="compare-product__title">{{$product->name}}</div>
					<div class="compare-product__ingredients">{{$product->ingredients->implode('name',', ')}}</div>
					<div class="compare-product__price">
						@if($product->old_price) <del>{{$product->old_price}} грн</del> @endif
						{{$product->new_price()}} грн
					</div>
					<a href="{{url('cart/add')}}" data-id="{{$product->id}}" class="ajax-send-id compare-product__buy button button_small">В КОРЗИНУ</a>
					<a href="{{url('comparelist/delete')}}" data-id="{{$product->id}}" class="ajax-send-id compare-product__remove"></a>
				</div>
			</div>
			@if (($i+1)%2==0||$comparelist->products->last()==$product) </div> @endif
		@endforeach
	@endif
</div>