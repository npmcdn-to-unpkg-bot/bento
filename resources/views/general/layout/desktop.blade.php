<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<title>@yield('title')</title>
	<meta name="title" content="@yield('meta-title')">
	<meta name="description" content="@yield('meta-description')">
	<meta name="csrf-token" content="{{csrf_token()}}">
	@stack('styles')
	<link rel="stylesheet" href="/bower/datetimepicker/build/jquery.datetimepicker.min.css">
	<link rel="stylesheet" href="{{url('bower/fancybox/source/jquery.fancybox.css')}}">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css">
	<link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=latin,cyrillic' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="{{url('css/desktop.css')}}">
</head>
<body>
	<div class="container-fluid container-fluid_lightgray">
		<div class="container container_fix">
			<div class="row">
				<div class="about-menu row__col-left">
					<a href="" class="about-menu__item">О ресторане</a>
					<a href="{{url('review/create')}}" class="about-menu__item">Оставить отзыв</a>
					<a href="" class="about-menu__item">Вакансии</a>
					<a href="" class="about-menu__item">Партнеры</a>
					<a href="{{url('blog')}}" class="about-menu__item">Блог</a>
				</div>
				<div class="user-menu row__col-right">
					<a href="{{url('checkout')}}" class="user-menu__box"><i style="color: #a3a3a3;font-size: 18px;" class="fa fa-shopping-cart"></i> Корзина </a>
					<a href="{{ $user ? url('account') : '#'}}" class="user-menu__box">
						<img class="user-menu__icon" src="{{url('img/user-menu-icon.png')}}" alt="">
						@if ($user) {{$user->first_name}} {{$user->last_name}} @else МОЙ АККАУНТ @endif
						<img src="{{url('img/user-menu-caret.png')}}" alt="" class="user-menu__icon">
					</a>
					<div class="user-menu__dropdown">
						@if (!$user)
						<a href="#login" class="fancybox user-menu__item user-menu__item_login">Вход</a>
						<a href="#register" class="fancybox user-menu__item user-menu__item_registration">Регистрация</a>
						@endif
						<a href="#wishlist" class="fancybox user-menu__item">Избранное</a>
						<a href="#comparelist" class="fancybox user-menu__item">Мои сравнения</a>
						<a href="{{url('checkout')}}" class="user-menu__item">Корзина</a>
						@if ($user)
						<a href="{{url('logout')}}" class="user-menu__item">Выход</a>
						@endif
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="container container_fix main-menu__before">
		<div class="row">
			<div class="row__col-left">
				<a href="{{url('/')}}" class="logo logo_dark logo_in-header">
					<img src="{{url('img/dark-logo.png')}}" alt="">
				</a>
			</div>
			<div class="row__col-left call-us call-us_in-header">
				<div class="call-us__title">ПРИЕМ ЗАКАЗОВ</div>
				<div class="call-us__phone">
					048<span class="call-us__red">-</span>77<span class="call-us__red">-</span>55<span class="call-us__red">-</span>000
				</div>
				<div class="call-us__schedule">
					с 10:00 до 22:30 ежедневно
				</div>
			</div>
			<form action="{{url('search')}}" class="row__col-right search search_in-header">
				<input name="q" type="text" placeholder="Поиск..." class="search__input" value="{{Request::get('q')}}">
				<button class="search__submit"></button>
			</form>
		</div>
	</div>
	<div style="height: 45px;">
		<div class="main-menu container-fluid container-fluid_lightgray">
			<div class="container container_fix main-menu__container">
				<div class="main-menu__item">МЕНЮ
					<div class="main-menu__dropdown">
						@foreach (App\Models\Category::all() as $category)
						<a href="/menu/{{$category->slug}}" class="main-menu__subitem">
							<img src="{{url($category->image)}}" alt="" class="main-manu__icon">
							<img src="/greyscale?image={{$category->image}}" alt="" class="main-manu__icon main-manu__icon_inverse">
							{{$category->name}}
						</a>
						@endforeach
					</div>
				</div>
				<a href="" class="main-menu__item">ДОСТАВКА И ОПЛАТА</a>
				<a href="{{url('news')}}" class="main-menu__item">НОВОСТИ И АКЦИИ</a>
				<a href="{{url('contacts')}}" class="main-menu__item">НАШИ КОНТАКТЫ</a>
			</div>
		</div>
	</div>
	<div class="main-slider container-fluid flexslider">
		<ul class="slides">
			@foreach(App\Models\Slide::all() as $slide)
			<li>
				<img src="/fit/1838/515?image={{$slide->image}}" alt="">
				<div class="main-slider__title" data-effect="{{$slide->title_effect}}" data-time="{{$slide->title_time}}">{!!$slide->title!!}</div>
				<div class="main-slider__text" data-effect="{{$slide->text_effect}}" data-time="{{$slide->text_time}}">{!!$slide->text!!}</div>
				@if($slide->button)
				<div class="main-slider__button" data-effect="{{$slide->button_effect}}" data-time="{{$slide->button_time}}">
				<a href="{{$slide->href}}" class="button button_small button_red">{!!$slide->button!!}</a>
				</div>
				@endif
			</li>
			@endforeach
		</ul>
	</div>
	@if (!Request::is('checkout'))
	<div class="floating-shoping-cart">
		@include('general.cart.block')
	</div>
	@endif
	@yield('content')
	<div class="container-fluid container-fluid_darkgray footer">
		<div class="container container_fix">
			<div class="row">
				<div class="row__col-left">
					<a href="" class="logo logo_light logo_in-footer">
						<img src="{{url('img/light-logo.png')}}" alt="">
					</a>
				</div>
				<div class="row__col-left footer-menu">
					<a href="" class="footer-menu__item">Меню</a>
					<a href="" class="footer-menu__item">Новости и акции</a>
					<a href="" class="footer-menu__item">Наши контакты</a>
					<a href="" class="footer-menu__item">Партнеры</a>
					<a href="" class="footer-menu__item">Вакансии</a>
					<a href="" class="footer-menu__item">BentoBar</a>
					<a href="" class="footer-menu__item">Условия доставки</a>
					<a href="" class="footer-menu__item">Доставка</a>
				</div>
				<div class="row__col-right social-buttons social-buttons_in-footer">
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

	<div style="display: none;">
	@include('general.comparelist.modal');
	@include('general.wishlist.modal');
	@if (!$user)
		@include('general.auth.register')
		@include('general.auth.login')
		@include('general.checkout.modal')
	@endif
	</div>

	<link rel="stylesheet" href="{{url('bower/animate.css/animate.min.css')}}">
	<script src="{{url('bower/jquery/dist/jquery.min.js')}}"></script>
	<script src="{{url('bower/smoothscroll-for-websites/SmoothScroll.js')}}"></script>
	<script src="{{url('bower/fancybox/source/jquery.fancybox.pack.js')}}"></script>
	<script src="{{url('bower/flexslider/jquery.flexslider-min.js')}}"></script>
	<script src="{{url('bower/imagesloaded/imagesloaded.pkgd.min.js')}}"></script>
	<script src="{{url('bower/datetimepicker/build/jquery.datetimepicker.full.min.js')}}"></script>
	<script src="{{url('bower/jquery.maskedinput/dist/jquery.maskedinput.min.js')}}"></script>
	<script src="{{url('js/main.js')}}"></script>
	@stack('scripts')

</body>
</html>