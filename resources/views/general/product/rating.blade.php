<div class="rating">
	<span class="rating__value" style="width: {{$product->votes->avg('value')/5*100}}%"></span>
		<a href="/product/{{$product->id}}/vote/1" class="rating__star"></a>
		<a href="/product/{{$product->id}}/vote/2" class="rating__star"></a>
		<a href="/product/{{$product->id}}/vote/3" class="rating__star"></a>
		<a href="/product/{{$product->id}}/vote/4" class="rating__star"></a>
		<a href="/product/{{$product->id}}/vote/5" class="rating__star"></a>
</div>

@if ($user)
	@push('scripts')
	<script>
		$('.rating__star').on('click',function(event){
			var rating = $(this).parents('.rating');
			event.preventDefault()
			$.ajax({
				url: this.href,
				success: function(response){
					rating.find('.rating__value').css({
						width: response.width + '%'
					})
				}
			})
		})
	</script>
	@endpush
@endif