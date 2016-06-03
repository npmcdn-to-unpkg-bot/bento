@extends('general.layout.desktop')

@section('content')
	<div class="container">
		<div class="title">
			<span class="title__text">НОВИНКИ ОТ <strong>BENTO</strong></span>
		</div>
		@include('general.product.list',['products' => App\Models\Product::orderBy('created_at')->take(6)->get()])
	</div>
	<div class="container-fluid visit-us">
		<div class="container">
			<div class="container__col-6">
				<div class="visit-us__title">ПОСЕТИТЕ НАШ РЕСТОРАН</div>
				<div class="visit-us__text">Разнообразный и богатый опыт новая модель организационной деятельности играет важную роль в формировании дальнейших направлений развития. <br><br>
				Повседневная практика показывает, что укрепление и собой процесс внедрения и модернизации направлений прогрессивного развития. <br> <br>
				<strong>Днепропетровская дорога, 51 +38063-922-92-92</strong></div>
				<a href="" class="button button_red button_big visit-us__more">ПОДРОБНЕЕ</a>
			</div>
			<div class="container__col-6">
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
	<div class="container how-we-work">
		<div class="how-we-work__title">КАК МЫ РАБОТАЕМ?</div>
		<div class="container__col-4 how-we-work__item">
			<img src="img/how-we-work-1.png" alt=""><br>
			Только свежие <br>
			продукты
			<span class="how-we-work__plus">+</span>
		</div>
		<div class="container__col-4 how-we-work__item">
			<img src="img/how-we-work-2.png" alt=""><br>
			Только лучшие<br>
			повара
			<span class="how-we-work__equal">=</span>
		</div>
		<div class="container__col-4 how-we-work__item">
			<img src="img/how-we-work-3.png" alt=""><br>
			Только довольные<br>
			клиенты
		</div>
	</div>
	<div class="container-fluid container-fluid_lightgray">
		<div class="container">
			<div class="container__main">
				<div class="title">
					<div class="title__text">НОВОСТИ И АКЦИИ</div>
				</div>
				@include('general.article.slider',['articles'=>[]])
			</div>
			<div class="container__side">
				<div class="title">
					<div class="title__text">БЛОГ</div>
				</div>
				@include('general.article.block',['articles'=>[]])
			</div>
		</div>
	</div>
	<div class="container advantages">
		<div class="container__col-4 advantages__item">
			<img src="img/advantages-1-hover.png" alt="" class="advantages__icon advantages__icon_inverse">
			<img src="img/advantages-1.png" alt="" class="advantages__icon">
			<div class="advantages__title">МЫ ВСЕГДА НА СВЯЗИ</div>
			<div class="advantages__text">Задача организации, в особенности <br> же дальнейшее</div>
		</div>
		<div class="container__col-4 advantages__item">
			<img src="img/advantages-2-hover.png" alt="" class="advantages__icon advantages__icon_inverse">
			<img src="img/advantages-2.png" alt="" class="advantages__icon">
			<div class="advantages__title">ШИРОКИЙ ВЫБОР В МЕНЮ</div>
			<div class="advantages__text">С другой стороны начало повседневной <br> работы по формированию</div>
		</div>
		<div class="container__col-4 advantages__item">
			<img src="img/advantages-3-hover.png" alt="" class="advantages__icon advantages__icon_inverse">
			<img src="img/advantages-3.png" alt="" class="advantages__icon">
			<div class="advantages__title">БЫСТРАЯ ДОСТАВКА</div>
			<div class="advantages__text">Таким образом консультация с активом <br> влечет</div>
		</div>
	</div>
	<div class="container-fluid">@include('general.review.slider')</div>
	<div class="container">
		<div class="title">
			<div class="title__text">ДОСТАВКА</div>
		</div>
			<div class="deliver">
				<img src="img/deliver.jpg" alt="" class="deliver__image">
				<div class="deliver__title">Доставка ваших любимых блюд по Одессе</div>
				<div class="deliver__text">
					С другой стороны постоянный количественный рост и сфера нашей 
					активности требуют от нас анализа систем массового участия. Не следует, 
					однако забывать, что реализация намеченных плановых заданий позволяет 
					оценить значение позиций, занимаемых участниками в отношении поставленных 
					задач. 
					<br><br>
					Таким образом укрепление и развитие структуры позволяет выполнять 
					важные задания по разработке системы обучения кадров, соответствует 
					насущным потребностям. Идейные соображения высшего порядка, а также 
				</div>
				<a href="" class="deliver__more button button_red">ПОДРОБНЕЕ</a>
			</div>
		</div>
	</div>
@endsection