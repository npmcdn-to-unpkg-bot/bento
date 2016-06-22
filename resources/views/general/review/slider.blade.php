<div class="reviews">
	<div class="container reviews__slider">
		<ul class="slides">
			<li>
				<img src="{{url('sample-images/review-1.jpg')}}" alt="" class="reviews__image">
				<div class="reviews__text">Очень люблю заказывать суши именно в Bento. Быстрая доставка, лучший сервис. Спасибо Вам большое за лучшие суши в городе</div>
				<div class="reviews__name">Анна Седакова</div>
			</li>
			<li>
				<img src="{{url('sample-images/review-2.jpg')}}" alt="" class="reviews__image">
				<div class="reviews__text">Очень люблю заказывать суши именно в Bento. Быстрая доставка, лучший сервис. Спасибо Вам большое за лучшие суши в городе</div>
				<div class="reviews__name">Илья Берёзкин</div>
			</li>
			<li>
				<img src="{{url('sample-images/review-1.jpg')}}" alt="" class="reviews__image">
				<div class="reviews__text">Очень люблю заказывать суши именно в Bento. Быстрая доставка, лучший сервис. Спасибо Вам большое за лучшие суши в городе</div>
				<div class="reviews__name">Анна Седакова</div>
			</li>
			<li>
				<img src="{{url('sample-images/review-2.jpg')}}" alt="" class="reviews__image">
				<div class="reviews__text">Очень люблю заказывать суши именно в Bento. Быстрая доставка, лучший сервис. Спасибо Вам большое за лучшие суши в городе</div>
				<div class="reviews__name">Илья Берёзкин</div>
			</li>			
		</ul>
	</div>
</div>

@push('scripts')
<script>
	$('.reviews__slider').flexslider({
		animation: "slide",
		@if (Agent::isMobile())
		itemWidth: 680,
		minItems: 1,
		maxItems: 1,
		@else
		itemWidth: 570,
		minItems: 2,
		maxItems: 2,
		@endif
		directionNav: false
	});
</script>
@endpush