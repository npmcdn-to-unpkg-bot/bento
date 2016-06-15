@extends(Agent::isMobile() ? 'general.layout.mobile' : 'general.layout.desktop')

@section('content')

<div class="container">
	<div class="title">
		<span class="title__text">ЛИЧНЫЙ КАБИНЕТ</span>
	</div>

	<div class="row">
		<div class="row__col-2"><img class="image_round" src="/fit/170/170?image={{$user->image ? $user->image : 'img/avatar.png'}}" alt=""></div>
		<div class="row__col-10">
			Личные данные / <a href="{{url('account/edit')}}">редактировать</a>
			<hr>
			<div style="width: 600px;">
				<div class="row offset_bottom_10">
					<div class="row__col-1 text_center"><i class="fa fa-red fa-user"></i></div>
					<div class="row__col-11">Вы: {{$user->first_name}} {{$user->last_name}}</div>
				</div>
				@if ($user->birth_day > Carbon\Carbon::now()->addYear(-100))
				<div class="row offset_bottom_10">
					<div class="row__col-1 text_center"><i class="fa fa-red fa-calendar"></i></div>
					<div class="row__col-11">Дата рождения: {{$user->birth_day->format('d.m.Y')}}</div>
				</div>
				@endif
				@if ($user->phone) 
				<div class="row offset_bottom_10">
					<div class="row__col-1 text_center"><i class="fa fa-red fa-phone"></i></div>
					<div class="row__col-6">Номер телефона: {{$user->phone}}</div>
					<div class="row__col-5">
						<div class="slide-info">
							<span onclick="$('#phones').slideToggle()" class="slide-info__link">дополнительные номера</span>
							<div id="phones" style="display: none;position: absolute;" class="slide-info__content">
								@foreach($user->phones as $phone)
								<div>{{$phone->name}} {{$phone->text}}</div>
								@endforeach
							</div>
						</div>
					</div>
				</div>
				@endif
				<div class="row offset_bottom_10">
					<div class="row__col-1 text_center"><i class="fa fa-red fa-envelope"></i></div>
					<div class="row__col-11">E-mail: {{$user->email}}</div>
				</div>
				@if ($user->place) 
				<div class="row offset_bottom_10">
					<div class="row__col-1 text_center"><i class="fa fa-red fa-map-marker"></i></div>
					<div class="row__col-6">Адрес доставки: {{$user->place}}</div>
					<div class="row__col-5">
						<div class="slide-info">
							<span onclick="$('#places').slideToggle()" class="slide-info__link">дополнительные адреса</span>
							<div id="places" style="display: none;position: absolute;" class="slide-info__content">
								@foreach($user->places as $place)
								<div>{{$place->name}} {{$place->text}}</div>
								@endforeach
							</div>
						</div>
					</div>
				</div>
				@endif
			</div>
		</div>
	</div>

	<div class="title title_small">
		<span class="title__text">ТЕКУЩИЕ ЗАКАЗЫ</span>
	</div>

	@include('general.account.orders',[
		'orders' => $user->orders->whereIn('status',[
						'В обработке',
						'Принят',
						'Приготовлен',
						'В пути'
					])
	])


	<div class="title title_small">
		<span class="title__text">ИСТОРИЯ ЗАКАЗОВ</span>
	</div>
	
	<div class="text_right">
		<span class="toggle-arrow" onclick="$('#history').slideToggle(); $(this).toggleClass('toggle-arrow__active')">
			<img src="/img/dropdown-carret.png" alt="">
		</span>
	</div>

	<div class="history-total offset_bottom_10">
		<div class="row">
			<div class="row__col-6">
				Общее количество заказов:
				<span class="history-total__value">{{
					$user->orders->whereIn('status',['Доставлен'])->count()
				}}</span>
			</div>
			<div class="row__col-6 text_right">
				Общая сумма: 
				<span class="history-total__value">{{
					$user->orders->whereIn('status',['Доставлен'])->sum(function($order){
						return $order->sum();
					})
				}}</span>
			</div>
		</div>
	</div>

	<div id="history" style="display: none;">

	@include('general.account.orders',[
		'orders' => $user->orders->whereIn('status',[
						'Доставлен',
					])
	])

	</div>

</div>

@endsection
