<div id="comparelist" class="modal">
	<div class="modal__title">СРАВНЕНИЕ ТОВАРОВ</div>
	<table class="products-table">
		<tr>
			<th rowspan="2"></th>
			<th rowspan="2">Продукт</th>
			<th rowspan="2" style="width: 200px;">Наименование</th>
			<th rowspan="2" style="width: 110px;" >Вес</th>
			<th colspan="4">Пищевая ценность на 100 г.</th>
			<th rowspan="2" style="width: 110px;">Цена</th>
			<th rowspan="2" style="width: 150px;"></th>
		</tr>
		<tr>
			<th style="width: 110px;">Белки</th>
			<th style="width: 110px;">Жиры</th>
			<th style="width: 110px;">Углеводы</th>
			<th style="width: 110px;">ККал</th>
		</tr>
		@if ($wishlist = $comparelist)
		@foreach ($wishlist->products as $product)
		<tr>
			<td class="products-table__remove-wrap"><a href="{{url('comparelist/toggle')}}" data-id="{{$product->id}}" class="button_comparelist products-table__remove"></a></td>
			<td class="products-table__image-wrap"><img src="width/100?image={{$product->image}}" alt=""></td>
			<td class="products-table__name-wrap">
				{{$product->name}}
				<div class="products-table__ingredients">{{$product->ingredients->implode('name',', ')}}</div>
			</td>
			<td>{{ $product->weight() }} г.</td>
			<td>{{ $product->carbs() }} г.</td>
			<td>{{ $product->fats() }} г.</td>
			<td>{{ $product->proteins() }} г.</td>
			<td>{{ $product->kcal() }} ккал</td>
			<td>
				@if($product->old_price)<del>{{$product->old_price}} грн</del> <br>@endif
				{{$product->new_price()}} грн</td>
			<td class="products-table__buy-wrap">
				@include('general.product.add_to_cart')
			</td>
		</tr>
		@endforeach
		@endif
	</table>

	<div class="modal__buttons">
		<a href="#" onclick="$.fancybox.close()" class="button button_small button_gray">Продолжить покупки</a>
		<a href="" class="button button_small button_red">Перейти в корзину</a>
	</div>
</div>