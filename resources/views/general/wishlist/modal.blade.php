<div id="wishlist" class="modal">
	<div class="modal__title">ИЗБРАННЫЕ ТОВАРЫ</div>
	<table class="products-table">
		<tr>
			<th></th>
			<th>Товары</th>
			<th></th>
			<th>Цена</th>
			<th></th>
		</tr>
		@if ($wishlist = App\Models\Wishlist::get())
		@foreach ($wishlist->products as $product)
		<tr>
			<td class="products-table__remove-wrap"><a href="{{url('wishlist/delete')}}" data-id="{{$product->id}}" class="ajax-send-id product-table__remove"></a></td>
			<td class="products-table__image-wrap"><img src="width/100?image={{$product->image}}" alt=""></td>
			<td class="products-table__name-wrap">{{$product->name}}</td>
			<td class="products-table__price-wrap">
				@if($product->old_price)<del>{{$product->old_price}} грн</del>@endif
				{{$product->new_price()}} грн</td>
			<td class="products-table__buy-wrap"><a href="{{url('cart/add')}}" data-id="{{$product->id}}" class="ajax-send-id products-table__buy button button_small">В КОРЗИНУ</a></td>
		</tr>
		@endforeach
		@endif
	</table>

	<div class="modal__buttons">
		<a href="#" onclick="$.fancybox.close()" class="button button_small button_gray">Продолжить покупки</a>
		<a href="" class="button button_small button_red">Перейти в корзину</a>
	</div>
</div>