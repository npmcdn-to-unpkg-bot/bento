@extends(Agent::isMobile() ? 'general.layout.mobile' : 'general.layout.desktop')

@section('content')
<div class="container">
	@include('general.article.list')
</div>
@endsection