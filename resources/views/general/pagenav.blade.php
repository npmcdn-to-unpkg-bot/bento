<div class="page-nav">
	@if ($items->currentPage() > 1)
		<a href="{{ $items->previousPageUrl() }}" class="page-nav__item page-nav__item_prev"></a>
	@endif
	@if ($items->lastPage() > 1)
		@for ($i=1;$i<=$items->lastPage();$i++)
			<a href="{{ $items->url($i) }}" class="page-nav__item {{ $i==$items->currentPage()?'page-nav__item_active':'' }}" >{{ $i }}</a>
		@endfor
	@endif
	@if ($items->currentPage() < $items->lastPage())
	<a href="{{ $items->nextPageUrl() }}" class="page-nav__item page-nav__item_next"></a>
	@endif
</div>