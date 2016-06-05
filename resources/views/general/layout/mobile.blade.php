<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<title>@yield('title')</title>
	<meta name="viewport" content="width=720px, user-scalable=no">
	<link rel="stylesheet" href="{{url('bower/fancybox/source/jquery.fancybox.css')}}">
	<link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=latin,cyrillic' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="{{url('css/mobile.css')}}">
</head>
<body>
	<div class="container">
		<div class="row">
			<div class="row__col-mob-6 text_center">
				<a href="{{url('/')}}" class="logo logo_dark logo_in-header">
					<img src="{{url('img/dark-logo.png')}}" alt="">
				</a>
			</div>
			<div class="row__col-mob-6 text_center">
				<div class="call-us offset-mob_top_30">
					<div class="call-us__title">ПРИЕМ ЗАКАЗОВ</div>
					<div class="call-us__phone">
						048<span class="call-us__red">-</span>77<span class="call-us__red">-</span>55<span class="call-us__red">-</span>000
					</div>
					<div class="call-us__schedule">
						с 10:00 до 22:30 ежедневно
					</div>
				</div>
			</div>
		</div>
		<div class="row offset-mob_bottom_30">
			<div class="row__col-mob-6">
				<div class="text_center">
					<a href="#main-menu" class="sandwich" data-toggle="slide">МЕНЮ</a>
				</div>
				<div id="main-menu" class="main-menu">
					<a href="" class="main-menu__item">МЕНЮ</a>
					<a href="" class="main-menu__item">ДОСТАВКА И ОПЛАТА</a>
					<a href="" class="main-menu__item">НОВОСТИ И АКЦИИ</a>
					<a href="" class="main-menu__item">НАШИ КОНТАКТЫ</a>
					<hr>
					<a href="" class="main-menu__item">О ресторане</a>
					<a href="" class="main-menu__item">Оставить отзыв</a>
					<a href="" class="main-menu__item">Вакансии</a>
					<a href="" class="main-menu__item">Партнеры</a>
					<a href="{{url('blog')}}" class="main-menu__item">Блог</a>
					<hr>
					@if (!auth()->user())
					<a href="#login" class="fancybox main-menu__item">Вход</a>
					<a href="#register" class="fancybox main-menu__item">Регистрация</a>
					@endif
					<a href="" class="main-menu__item">Избранное</a>
					<a href="" class="main-menu__item">Мои сравнения</a>
					<a href="" class="main-menu__item">Корзина</a>
					@if (auth()->user())
					<a href="{{url('logout')}}" class="main-menu__item">Выход</a>
					@endif
				</div>				
			</div>
			<div class="row__col-mob-6 text_center">
				<form class="search">
					<input type="text" placeholder="Поиск..." class="search__input">
					<button class="search__submit"></button>
				</form>
			</div>
		</div>
	</div>
	<div class="main-slider container-fluid flexslider">
		<ul class="slides">
			<li><img src="{{url('sample-images/slide-1.jpg')}}" alt=""></li>
			<li><img src="{{url('sample-images/slide-1.jpg')}}" alt=""></li>
			<li><img src="{{url('sample-images/slide-1.jpg')}}" alt=""></li>
		</ul>
	</div>
	@include('general.carts.cart')
	@yield('content')
	<div class="container-fluid container-fluid_darkgray footer">
		<div class="container container_fix">
			<div class="row offset-mob_top_30">
				<div class="row__col-left row__col-mob-4">
					<a href="" class="logo logo_light">
						<img src="{{url('img/light-logo.png')}}" alt="">
					</a>
				</div>
				<div class="row__col-left row__col-mob-8 footer-menu">
					<a href="" class="footer-menu__item">Меню</a>
					<a href="" class="footer-menu__item">Новости и акции</a>
					<a href="" class="footer-menu__item">Наши контакты</a>
					<a href="" class="footer-menu__item">Партнеры</a>
					<a href="" class="footer-menu__item">Вакансии</a>
					<a href="" class="footer-menu__item">BentoBar</a>
					<a href="" class="footer-menu__item">Условия доставки</a>
					<a href="" class="footer-menu__item">Доставка</a>
				</div>
				<div class="row__col-right row__col-mob-12 offset-mob_top_30 offset-mob_bottom_30 text_center social-buttons">
					<a href="" class="social-buttons__item social-buttons__item_vk"></a>
					<a href="" class="social-buttons__item social-buttons__item_tw"></a>
					<a href="" class="social-buttons__item social-buttons__item_lj"></a>
					<a href="" class="social-buttons__item social-buttons__item_ok"></a>
					<a href="" class="social-buttons__item social-buttons__item_gp"></a>
					<a href="" class="social-buttons__item social-buttons__item_fb"></a>
				</div>
			</div>
		</div>
	</div>

	<script src="{{url('bower/jquery/dist/jquery.min.js')}}"></script>
	<script src="{{url('bower/fancybox/source/jquery.fancybox.pack.js')}}"></script>
	<script src="{{url('bower/flexslider/jquery.flexslider-min.js')}}"></script>
	<script src="{{url('bower/imagesloaded/imagesloaded.pkgd.min.js')}}"></script>
	<script src="{{url('js/main.js')}}"></script>


	@if (!auth()->user())
	<div style="display: none;">
		@include('general.modal.register')
		@include('general.modal.login')
		@include('general.modal.checkout')
	</div>
	@endif
</body>
</html>