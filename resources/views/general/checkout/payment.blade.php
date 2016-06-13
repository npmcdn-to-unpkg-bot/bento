<div class="sub-title offset_bottom_30">СПОСОБ ОПЛАТЫ</div>

<div class="row offset_bottom_30">
	<div class="row__col-6 text_center">
		<label>
		<img src="/img/cash.png" alt="">
		<div class="offset_top_10">
			<input type="radio" checked class="" name="payment"> Наличными при получении
		</div>
		</label>
	</div>
	<div class="row__col-6 text_center">
		<label>
		<img src="/img/visa-mcard.png" alt="">
		<div class="offset_top_10">
			<input type="radio" class="" name="payment"> visa/mastercard
		</div>
		</label>
	</div>
	<div class="row__col-12"><div class="error">{{$errors->first('payment')}}</div></div>
</div>