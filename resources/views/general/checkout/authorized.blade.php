	<div class="sub-title offset_bottom_10">КУДА ВЕЗЕМ</div>
	<div class="row">
		<div class="row__col-6">
			@foreach ($user->places as $i => $place)
			<div class="offset_bottom_10">
				<label><input type="radio" name="place" value="{{$place->text}}"> {{$place->name}} {{$place->text}}</label>
			</div>
			@endforeach
		</div>
		<div class="row__col-6">
			@if ($user->phone)
			<div class="offset_bottom_10">
				<label><input type="radio" name="phone" value="{{$user->phone}}"> Основной номер телефона {{$user->phone}}</label>
			</div>
			@endif
			@foreach ($user->phones as $i => $phone)
			<div class="offset_bottom_10">
				<label><input type="radio" name="phone" value="{{$phone->text}}"> {{$phone->name}} {{$phone->text}}</label>
			</div>
			@endforeach
		</div>
	</div>
	<div class="row offset_bottom_10">
		<div class="row__col-6">
			<div class="optional-input">
				<input id="new_place" type="radio" @if(old('place')==old('new_place')) checked @endif class="optional-input__checkbox" name="place" value="{{old('new_place')}}"> <input type="text" onchange="$('#new_place').val(this.value)" onfocus="$('#new_place').click()" class="input input_100 optional-input__input" name="new_place" placeholder="Другой адрес" value="{{old('new_place')}}">
			</div>
			<div class="error">{{$errors->first('place')}}</div>
		</div>
		<div class="row__col-6">
			<div class="optional-input">
				<input id="new_phone" type="radio" @if(old('phone')==old('new_phone')) checked @endif class="optional-input__checkbox" name="phone" value="{{old('new_phone')}}"> <input type="text" onchange="$('#new_phone').val(this.value)" onfocus="$('#new_phone').click()" class="input input_100 optional-input__input" name="new_phone" placeholder="Другой телефон" value="{{old('new_phone')}}">
			</div>
			<div class="error">{{$errors->first('phone')}}</div>
		</div>
	</div>
	<div class="row">
		<div class="row__col-6">
			<div class="offset_bottom_10">
				<select type="text" name="perosns" placeholder="Количество персон" class="input input_100">
					<option value="0">Количество персон</option>
					@for($i=1;$i<10;$i++)<option value="{{$i}}">{{$i}}</option>@endfor
				</select>
			</div>
		</div>
		<div class="row__col-6">
			<div class="offset_bottom_10">
				<input type="text" name="time" class="input input_100" placeholder="Время доставки">
			</div>
		</div>
	</div>