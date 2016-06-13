<div class="sub-title offset_bottom_10">КУДА И КОМУ ВЕЗЕМ</div>
<div class="row">
	<div class="row__col-6">
		<div class="offset_bottom_10">
			<input type="text" class="input input_100" name="first_name" placeholder="Ваше имя">
		</div>
		<div class="offset_bottom_10">
			<input type="email" class="input input_100" name="email" placeholder="Ваш email">
		</div>
		<div class="offset_bottom_10">
			<input type="text" class="input input_100" name="place" placeholder="Ваш адрес">
		</div>
	</div>
	<div class="row__col-6">
		<div class="offset_bottom_10">
			<input type="text" class="input input_100" name="last_name" placeholder="Ваша фамилия">
		</div>
		<div class="offset_bottom_10">
			<input type="text" class="input input_100" name="phone" placeholder="Ваш телефон">
		</div>
		<div class="row offset_bottom_10">
			<div class="row__col-6">
				<select type="text" name="perosns" placeholder="Количество персон" class="input input_100">
					<option value="0">Количество персон</option>
					@for($i=1;$i<10;$i++)<option value="{{$i}}">{{$i}}</option>@endfor
				</select>
			</div>
			<div class="row__col-6">
				<input type="text" class="input input_100" name="time" placeholder="Время доставки">
			</div>
		</div>
	</div>
</div>
