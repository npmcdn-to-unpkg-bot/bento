<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<title>@yield('title')</title>
	<meta name="csrf-token" content="{{csrf_token()}}">
	<meta name="viewport" content="width=720px, user-scalable=no">
	<link rel="stylesheet" href="{{url('bower/fancybox/source/jquery.fancybox.css')}}">
	<link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=latin,cyrillic' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="{{url('css/mobile.css')}}">
</head>
<body>
	<div class="floating-menu">
		<div class="container">
			<div class="row">
				<div class="row__col-mob-2">
					<a href="{{url('/')}}" class="logo logo_dark floating-menu__item">
						<img src="{{url('img/dark-logo.png')}}" alt="">
					</a>
				</div>
				<div class="row__col-mob-10">
					<div class="row">
						@if (auth()->user())
						<div class="row__col-mob-6 floating-menu__border-left">
							<a href="" class="floating-menu__item">{{auth()->user()->first_name}} {{auth()->user()->last_name}}</a>
						</div>
						@else
						<div class="row__col-mob-3 floating-menu__border-left">
							<a href="#login" class="fancybox floating-menu__item">
								<img height="30px" src="/img/floating-menu__item/login.png" alt=""><br>
								Вход
							</a>
						</div>
						<div class="row__col-mob-3 floating-menu__border-left">
							<a href="#register" class="fancybox floating-menu__item">
								<img height="30px" src="/img/floating-menu__item/register.png" alt=""><br>
								Регистрация
							</a>
						</div>
						@endif
						<div class="row__col-mob-3 floating-menu__border-left">
							<a href="#shoping-cart" class="floating-menu__item" data-toggle="slide">
								<img height="30px" src="/img/floating-menu__item/cart.png" alt=""><br>
								Заказ
							</a>
							<div id="shoping-cart" class="toggle-menu">
								@include('general.cart.block')
							</div>
						</div>
						<div class="row__col-mob-3 floating-menu__border-left">
							<a href="#main-menu" class="floating-menu__item" data-toggle="slide">
								<img height="30px" src="/img/floating-menu__item/menu.png" alt=""><br>
								Меню
							</a>
							<div id="main-menu" class="main-menu toggle-menu">
								@foreach (App\Models\Category::all() as $category)
								<a href="/menu/{{$category->slug}}" class="main-menu__item">{{$category->name}}</a>
								@endforeach
								<hr>
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
					</div>
				</div>
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
		@include('general.auth.register')
		@include('general.auth.login')
		@include('general.checkout.modal')
	</div>
	@endif
</body>
</html>