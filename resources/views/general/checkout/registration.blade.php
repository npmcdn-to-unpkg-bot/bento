<div class="offset_bottom_30 text_center">
	<a href="#checkout" class="fancybox button button_red button_small">ОФОРМИТЬ В 1 КЛИК</a>
</div>
<div class="sub-title offset_bottom_10">КУДА И КОМУ ВЕЗЕМ</div>
<div class="row">
	<div class="row__col-6">
		<div class="offset_bottom_10">
			<input type="text" class="input input_100" name="first_name" placeholder="Ваше имя" value="{{old('first_name')}}">
			<div class="error">{{$errors->first('first_name')}}</div>
		</div>
		<div class="offset_bottom_10">
			<input type="email" class="input input_100" name="email" placeholder="Ваш email" value="{{old('email')}}">
			<div class="error">{{$errors->first('email')}}</div>
		</div>
		<div class="offset_bottom_10">
			<input type="password" class="input input_100" name="password" placeholder="Пароль для личного кабинета">
			<div class="error">{{$errors->first('password')}}</div>
		</div>
		<div class="offset_bottom_10">
			<input type="text" class="input input_100" name="place" placeholder="Ваш адрес" value="{{old('place')}}">
			<div class="error">{{$errors->first('place')}}</div>
		</div>
	</div>
	<div class="row__col-6">
		<div class="offset_bottom_10">
			<input type="text" class="input input_100" name="last_name" placeholder="Ваша фамилия" value="{{old('last_name')}}">
			<div class="error">{{$errors->first('last_name')}}</div>
		</div>
		<div class="offset_bottom_10">
			<input type="text" class="input input_100" name="phone" placeholder="Ваш телефон" value="{{old('phone')}}">
			<div class="error">{{$errors->first('phone')}}</div>
		</div>
		<div class="offset_bottom_10">
			<input type="password" class="input input_100" name="password_confirmation" placeholder="Повторите пароль">
		</div>
		<div class="row offset_bottom_10">
			<div class="row__col-6">
				<select type="text" name="persons" placeholder="Количество персон" class="input input_100">
					<option value="0">Количество персон</option>
					@for($i=1;$i<10;$i++)<option @if ($i==old('persons')) selected @endif value="{{$i}}">{{$i}}</option>@endfor
				</select>
			</div>
			<div class="row__col-6">
				<input type="text" class="input input_100" name="time" placeholder="Время доставки" value="{{old('time')}}">
			</div>
		</div>
	</div>
</div>
