<a 
	href="{{url('comparelist/toggle/'.$product->id)}}" 
	data-id="{{$product->id}}" 
	class="button_comparelist @if(Comparelist::has($product)) button_red @endif product__compare button button_small"
><i class="fa fa-exchange"></i></a>
<a 
	href="{{url('wishlist/toggle/'.$product->id)}}" 
	data-id="{{$product->id}}" 
	class="button_wishlist @if(Wishlist::has($product)) button_red @endif product__wish button button_small"
><i class="fa fa-heart-o"></i></a>
@include('general.product.add_to_cart')