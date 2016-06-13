<div id="wishlist" class="modal">
	<div class="modal__title">ИЗБРАННЫЕ ТОВАРЫ</div>
	@if ($wishlist = $wishlist)
		@foreach($wishlist->products as $i => $product)
			@if ($i%2==0) <div class="row"> @endif
			<div class="row__col-6">
				<div class="wishlist">
					<img src="/width/100/?image={{$product->image}}" alt="" class="wishlist__image">
					<div class="wishlist__title">{{$product->name}}</div>
					<div class="wishlist__ingredients">{{$product->ingredients->implode('name',', ')}}</div>
					<div class="wishlist__price">
						@if($product->old_price) <del>{{$product->old_price}} грн</del> @endif
						{{$product->new_price()}} грн
					</div>
					<div class="wishlist__buy">@include('general.product.add_to_cart')</div>
					<a href="{{url('wishlist/toggle')}}" data-id="{{$product->id}}" class="button_wishlist wishlist__remove"></a>
				</div>
			</div>
			@if (($i+1)%2==0||$wishlist->products->last()==$product) </div> @endif
		@endforeach
	@endif
</div>