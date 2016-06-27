@extends(Agent::isMobile() ? 'general.layout.mobile' : 'general.layout.desktop')

@section('content')

<div class="container">
	<div class="title">
		<span class="title__text">ЛИЧНЫЙ КАБИНЕТ</span>
	</div>
	<form action="{{url('account')}}" method="POST" enctype="multipart/form-data">
	{!!csrf_field()!!}
	<div class="title title_small">
		<span class="title__text">ЛИЧНЫЕ ДАННЫЕ</span>
	</div>
	<div class="form-group">
		<div class="row offset_bottom_10">
			<div class="row__col-2">Ваше имя <span class="error">*</span></div>
			<div class="row__col-5">
				<input type="text" class="input input_100" placeholder="Иван" name="first_name" value="{{old()?old('first_name'):$user->first_name}}">
				<div class="error">{{$errors->first('first_name')}}</div>
			</div>
		</div>
		<div class="row offset_bottom_10">
			<div class="row__col-2">Ваша фамилия <span class="error">*</span></div>
			<div class="row__col-5">
				<input type="text" class="input input_100" placeholder="Иванов" name="last_name" value="{{old()?old('last_name'):$user->last_name}}">
				<div class="error">{{$errors->first('last_name')}}</div>
			</div>
		</div>
		<div class="row offset_bottom_10">
			<div class="row__col-2">Дата рождения <span class="error">*</span></div>
			<div class="row__col-5">
                <div class="date-picker input input_100">
                    <select class="date-picker__item date-picker__day">
                        <option value="">число</option>
                        @for ($i=1;$i<=31;$i++)
                        <option value="{{$i}}">{{$i}}</option>
                        @endfor
                    </select>
                    <select class="date-picker__item date-picker__month">
                        <option value="0">месяц</option>
                        <option value="1">январь</option>
                        <option value="2">февраль</option>
                        <option value="3">март</option>
                        <option value="4">апрель</option>
                        <option value="5">май</option>
                        <option value="6">июнь</option>
                        <option value="7">июль</option>
                        <option value="8">август</option>
                        <option value="9">сентябрь</option>
                        <option value="10">октябрь</option>
                        <option value="11">ноябрь</option>
                        <option value="12">декабрь</option>
                    </select>
                    <select class="date-picker__item date-picker__year">
                        <option value="">год рождения</option>
                        @for ($i=Carbon\Carbon::now()->year;$i>=1900;$i--)
                        <option value="{{$i}}">{{$i}}</option>
                        @endfor
                    </select>
                </div>
			</div>
		</div>
		<div class="row offset_bottom_10">
			<div class="row__col-2">Ваш адрес <span class="error">*</span></div>
			<div class="row__col-5">
				<input type="text" class="input input_100" placeholder="Набережная 1" name="place" value="{{old()?old('place'):$user->place}}">
				<div class="error">{{$errors->first('place')}}</div>
			</div>
		</div>
		<div class="row offset_bottom_10">
			<div class="row__col-2">Ваш телефон <span class="error">*</span></div>
			<div class="row__col-5">
				<input type="text" class="input input_100" placeholder="+380123121231" name="phone" value="{{old()?old('phone'):$user->phone}}">
				<div class="error">{{$errors->first('phone')}}</div>
			</div>
		</div>
	</div>
	<div class="title title_small">
		<span class="title__text">ДОПОЛНИТЕЛЬНЫЕ ТЕЛЕФОНЫ</span>
	</div>
	<div class="form-group">
		@foreach($user->phones as $phone)
		<div class="multiple-field offset_bottom_30">
			<div class="row offset_bottom_10">
				<div class="row__col-2">Название:</div>
				<div class="row__col-5"><input name="phones[name][{{$phone->id}}]" class="input input_100" value="{{$phone->name}}"></div>
			</div>		
			<div class="row offset_bottom_10">
				<div class="row__col-2">Телефон:</div>
				<div class="row__col-5"><input name="phones[text][{{$phone->id}}]" class="input input_100" value="{{$phone->text}}"></div>
				<div class="row__col-1"><a href="#" class="multiple-field__delete"><img src="/img/delete.png" alt=""></a></div>
			</div>
		</div>
		@endforeach
		<div class="row offset_bottom_10">
			<div class="row__col-5 row__col-offset-2"><a href="#newPhone" class="multiple-field__add button button_red button_100 button_small">ДОБАВИТЬ НОВЫЙ ТЕЛЕФОН</a></div>
		</div>
	</div>

	<div class="title title_small">
		<span class="title__text">ДОПОЛНИТЕЛЬНЫЕ АДРЕСА</span>
	</div>

	<div class="form-group">
		@foreach($user->places as $place)
		<div class="multiple-field offset_bottom_30">
			<div class="row offset_bottom_10">
				<div class="row__col-2">Название:</div>
				<div class="row__col-5"><input name="places[name][{{$place->id}}]" class="input input_100" value="{{$place->name}}"></div>
			</div>
			<div class="row offset_bottom_10">
				<div class="row__col-2">Адрес:</div>
				<div class="row__col-5"><input name="places[text][{{$place->id}}]" class="input input_100" value="{{$place->text}}"></div>
				<div class="row__col-1"><a href="#" class="multiple-field__delete"><img src="/img/delete.png" alt=""></a></div>
			</div>
		</div>
		@endforeach
		<div class="row offset_bottom_10">
			<div class="row__col-5 row__col-offset-2"><a href="#newPlace" class="multiple-field__add button button_red button_100 button_small">ДОБАВИТЬ НОВЫЙ АДРЕСС</a></div>
		</div>
	</div>

	<div class="title title_small">
		<span class="title__text">ИЗМЕНИТЬ АВАТАРКУ</span>
	</div>

	<div class="form-group">
		<div class="row offset_bottom_30">
			<div class="row__col-2">Загрузить новую аватарку: </div>
			<div class="row__col-5">
				<input type="file" name="upload">
			</div>
		</div>
		<div class="row offset_bottom_10">
			<div class="row__col-2">Текущее изображение: </div>
			<div class="row__col-5">
				<input type="hidden" name="image" value="{{$user->image}}">
				<img src="/fit/120/120?image={{$user->image ? $user->image : 'img/avatar.png' }}" alt="" class="image_round">
			</div>
		</div>
	</div>

	<div class="text_right offset_bottom_30 offset_top_30"><button type="submit" class="button button_red button_small">СОХРАНИТЬ ИЗМЕНЕНИЯ</button></div>

	</form>

	<div style="display: none;">

		<div id="newPhone" class="multiple-field offset_bottom_30">
			<div class="row offset_bottom_10">
				<div class="row__col-2">Название:</div>
				<div class="row__col-5"><input name="phones[name][]" class="input input_100" value=""></div>
			</div>
			<div class="row offset_bottom_10">
				<div class="row__col-2">Телефон:</div>
				<div class="row__col-5"><input name="phones[text][]" class="input input_100" value=""></div>
				<div class="row__col-1"><a href="#" class="multiple-field__delete"><img src="/img/delete.png" alt=""></a></div>
			</div>
		</div>

		<div id="newPlace" class="multiple-field offset_bottom_30">
			<div class="row offset_bottom_10">
				<div class="row__col-2">Название:</div>
				<div class="row__col-5"><input name="places[name][]" class="input input_100" value=""></div>
			</div>
			<div class="row offset_bottom_10">
				<div class="row__col-2">Адрес:</div>
				<div class="row__col-5"><input name="places[text][]" class="input input_100" value=""></div>
				<div class="row__col-1"><a href="#" class="multiple-field__delete"><img src="/img/delete.png" alt=""></a></div>
			</div>
		</div>

	</div>

</div>

@endsection
