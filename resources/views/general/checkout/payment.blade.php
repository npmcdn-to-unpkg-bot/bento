<div class="sub-title offset_bottom_30">СПОСОБ ОПЛАТЫ</div>

<div class="row offset_bottom_30">
	<div class="row__col-4 text_center">
		<label>
		<img src="/img/cash.png" alt="">
		<div class="offset_top_10">
			<input type="radio" checked class="" value="Наличными при получении" name="payment_method"> Наличными при получении
		</div>
		</label>
	</div>
	<div class="row__col-4 text_center">
		<label>
		<img src="/img/visa-mcard.png" alt="">
		<div class="offset_top_10">
			<input type="radio" class="" value="Онлайн оплата visa/mastercard" name="payment_method"> visa/mastercard
		</div>
		</label>
	</div>
	<div class="row__col-4 text_center">
		<label>
		<img src="/img/cash.png" alt="">
		<div class="offset_top_10">
			<input type="radio" class="" @if(!$user||$user->bonus_account*App\Models\Setting::get('spend_points') < $cart->sum()) disabled @endif value="С бонусного счета" name="payment_method"> С бонусного счета
		</div>
		</label>
	</div>
	<div class="row__col-12"><div class="error">{{$errors->first('payment')}}</div></div>
</div>