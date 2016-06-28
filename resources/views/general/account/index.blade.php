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
				<div class="row__col-5">Номер телефона: {{$user->phone}}</div>
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
				<div class="row__col-5">Адрес доставки: {{$user->place}}</div>
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
			<div class="row offset_bottom_10">
				<div class="row__col-1 text_center"><i class="fa fa-red fa-money"></i></div>
				<div class="row__col-11">Бонусный счет: {{$user->bonus_account}}</div>
			</div>
		</div>
	</div>

	<div class="title title_small">
		<span class="title__text">ТЕКУЩИЕ ЗАКАЗЫ</span>
	</div>
	@foreach($user->orders->orderBy('created_at','desc')->whereIn('status',[ 'В обработке', 'Принят', 'Приготовлен', 'В пути' ]) as $order)
		@include('general.account.order')
	@endforeach

	<div class="title title_small">
		<span class="title__text">ИСТОРИЯ ЗАКАЗОВ</span>
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
				}} грн.</span>
			</div>
		</div>
	</div>

	<table class="orders-table offset_bottom_60">
		<tr>
			<th>Номер</th>
			<th>Время</th>
			<th>Статус</th>
			<th>Количество продуктов</th>
			<th>Сумма</th>
			<th></th>
		</tr>
		@foreach ($user->orders->whereIn('status',[ 'Доставлен' ]) as $order)
		 <tr>
		 	<td>#{{$order->id}}</td>
		 	<td>{{$order->created_at->format('d.m.Y H:i')}}</td>
		 	<td>{{$order->status}}</td>
		 	<td>{{$order->count()}}</td>
		 	<td>{{$order->sum()}} грн.</td>
		 	<td><a href="/account/order/{{$order->id}}" class="button button_small button_red">ПОДРОБНЕЕ</a></td>
		 </tr>
		@endforeach
	</table>

</div>

@endsection
