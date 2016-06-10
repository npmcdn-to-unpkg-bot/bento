@extends(Agent::isMobile() ? 'general.layout.mobile' : 'general.layout.desktop')

@section('title') {{ $product->name }} @endsection
@section('meta-title') {{$product->meta_title ? $product->meta_title : $product->name }} @endsection
@section('meta-desctiption') {{$product->meta_description ? $product->meta_description : $product->description }} @endsection

@section('content')
	<div class="container product-cart">
		<table>
			<tr>
				<td class="product-cart__image-wrap" rowspan="999">
					<a href="{{url($product->image)}}" class="fancybox"><img src="/width/720?image={{$product->image}}" alt="" class="product-cart__image"></a>
				</td>
				<td class="product-cart__name">{{$product->name}}</td>
			</tr>
			<tr>
				<td>
					<div class="rating">
						<span class="rating__value" style="width: 66%"></span>
						<a href="" class="rating__star"></a>
						<a href="" class="rating__star"></a>
						<a href="" class="rating__star"></a>
						<a href="" class="rating__star"></a>
						<a href="" class="rating__star"></a>
					</div>
				</td>
			</tr>
			<tr><td class="product-cart__text">{!!$product->description!!}</td></tr>
			<tr><td><span class="product-cart__weight">{{$product->weight()}}гр.</span>
			<span class="product__price">
				@if($product->old_price)<del>{{$product->old_price}} грн</del> @endif
				{{$product->new_price()}} грн
			</span>
			</td></tr>
			<tr>
				<td>
					<a href="" class="product-cart__compare button button_small"></a>
					<a href="" class="product-cart__wish button button_small"></a>
					<a href="{{url('cart/add')}}" data-id="{{$product->id}}" class="ajax-send-id product-cart__buy button button_small">В КОРЗИНУ</a>				
				</td>
			</tr>
			<tr>
				<td class="ingredients">
					@if ($product->ingredients)
					<div class="ingredients__title">Состав</div>
					@foreach($product->ingredients as $ingredient)
						<div class="ingredients__item">
							<div class="ingredients__icon"><img src="{{url($ingredient->image)}}" alt=""></div>
							<div class="ingredients__name">{{$ingredient->name}}</div>
						</div>
					@endforeach
					@endif
				</td>
			</tr>
			<tr>
				<td class="product-cart__share-buttons-wrap">
					<div class="offset_top_30">
						Расказать друзьям: <div class="share-buttons">@include('general.share')</div>
					</div>
				</td>
			</tr>
		</table>
		<table class="diet-table">
			<tr><th class="diet-table__title" colspan="4">Пищевая ценность на 100 грамм</th></tr>
			<tr>
				<td class="diet-table__label">Углеводы</td>
				<td class="diet-table__label">Жиры</td>
				<td class="diet-table__label">Белки</td>
				<td class="diet-table__label">Каллории</td>
			</tr>
			<tr>
				<td class="diet-table__value">{{ $product->carbs() }} г.</td>
				<td class="diet-table__value">{{ $product->fats() }} г.</td>
				<td class="diet-table__value">{{ $product->proteins() }} г.</td>
				<td class="diet-table__value">{{ $product->kcal() }} ккал</td>
			</tr>
		</table>
	</div>
	@if ($recommendations = App\Models\Setting::get('recommendations'))
		<div class="container">
			<div class="title">
				<span class="title__text">РЕКОМЕНДАЦИИ ОТ <strong>BENTO</strong></span>
			</div>
			@include('general.product.list',['products' => App\Models\Product::find($recommendations)])
		</div>
	@endif
	@include('general.review.slider')
	@include('general.block.advantages')
@endsection