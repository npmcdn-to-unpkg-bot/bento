<div class="container-fluid visit-us">
	<div class="container">
		<div class="row">
			<div class="row__col-6 row__col-mob-12 offset-mob_bottom_30">
				<div class="visit-us__title">ПОСЕТИТЕ НАШ РЕСТОРАН</div>
				<div class="visit-us__text">Разнообразный и богатый опыт новая модель организационной деятельности играет важную роль в формировании дальнейших направлений развития. <br><br>
				Повседневная практика показывает, что укрепление и собой процесс внедрения и модернизации направлений прогрессивного развития. <br> <br>
				<strong>Днепропетровская дорога, 51 +38063-922-92-92</strong></div>
				<a href="" class="button button_red button_big visit-us__more">ПОДРОБНЕЕ</a>
			</div>
			<div class="row__col-6 row__col-mob-12">
				<div class="visit-us__slider flexslider">
					<ul class="slides">
						<li><img src="sample-images/restaurant-1.jpg" alt=""></li>
						<li><img src="sample-images/restaurant-1.jpg" alt=""></li>
						<li><img src="sample-images/restaurant-1.jpg" alt=""></li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>

@push('scripts')
<script>
	$('.visit-us__slider').flexslider({
		controlNav: false,
		animation: "slide",
	    prevText: "",
	    nextText: ""	
	})
</script>
@endpush