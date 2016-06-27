@extends(Agent::isMobile() ? 'general.layout.mobile' : 'general.layout.desktop')

@section('content')
	<div class="container offset_bottom_60">
		<div class="title">
			<div class="title__text">ОСТАВИТЬ ОТЗЫВ</div>
		</div>
		<div class="row offset_bottom_10">
			<div class="row__col-2"><img src="/fit/180/180?image={{$user->image ? $user->image : 'img/avatar.png'}}" class="image_round" alt=""></div>
			<div class="row__col-10">
				<form action="{{url('review')}}" method="POST">
					{!!csrf_field()!!}
					<textarea name="text" class="input input_100 input_textarea offset_bottom_10" placeholder="Мне нравится!"></textarea>
					<button type="submit" class="button button_red button_small">ОСТАВИТЬ ОТЗЫВ</button>
				</form>	
			</div>
		</div>
	</div>

	@include('general.review.slider')


@endsection
