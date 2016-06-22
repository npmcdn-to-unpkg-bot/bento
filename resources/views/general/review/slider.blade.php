<div class="reviews">
	<div class="container reviews__slider">
		<ul class="slides">
			@foreach (App\Models\Review::where('published',1)->get() as $review)
			<li>
				<img src="/fit/170/170?image={{$review->user->image ? $review->user->image : 'img/avatar.png' }}" alt="" class="reviews__image">
				<div class="reviews__text">{{$review->text}}</div>
				<div class="reviews__name">{{$review->user->first_name}} {{$review->user->last_name}}</div>
			</li>
			@endforeach
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