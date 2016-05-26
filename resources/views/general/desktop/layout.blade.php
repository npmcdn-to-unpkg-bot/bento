<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>bento</title>
	<link rel="stylesheet" href="{{url('js/fancybox/jquery.fancybox.css')}}">
	<link rel="stylesheet" href="{{url('js/flexslider/flexslider.css')}}">
	<link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=latin,cyrillic' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="{{url('css/style.css')}}">
</head>
<body>
	<div class="container-fluid container-fluid_lightgray">
		<div class="container container_fix">
			<div class="about-menu container__col-left">
				<a href="" class="about-menu__item">О ресторане</a>
				<a href="" class="about-menu__item">Оставить отзыв</a>
				<a href="" class="about-menu__item">Вакансии</a>
				<a href="" class="about-menu__item">Партнеры</a>
				<a href="{{url('blog')}}" class="about-menu__item">Блог</a>
			</div>
			<div class="user-menu container__col-right">
				<div class="user-menu__box">
					<img class="user-menu__icon" src="{{url('img/user-menu-icon.png')}}" alt="">
					МОЙ АККАУНТ
					<img src="{{url('img/user-menu-caret.png')}}" alt="" class="user-menu__icon">
				</div>
				<div class="user-menu__dropdown">
					<a href="" class="user-menu__item user-menu__item_login">Вход</a>
					<a href="" class="user-menu__item user-menu__item_registration">Регистрация</a>
					<a href="" class="user-menu__item">Избранное</a>
					<a href="" class="user-menu__item">Мои сравнения</a>
					<a href="" class="user-menu__item">Корзина</a>
				</div>
			</div>
		</div>
	</div>
	<div class="container container_fix">
		<div class="container__col-left">
			<a href="{{url('/')}}" class="logo logo_dark logo_in-header">
				<img src="{{url('img/dark-logo.png')}}" alt="">
			</a>
		</div>
		<div class="container__col-left call-us call-us_in-header">
			<div class="call-us__title">ПРИЕМ ЗАКАЗОВ</div>
			<div class="call-us__phone">
				048<span class="call-us__red">-</span>77<span class="call-us__red">-</span>55<span class="call-us__red">-</span>000
			</div>
			<div class="call-us__schedule">
				с 10:00 до 22:30 ежедневно
			</div>
		</div>
		<form class="container__col-right search search_in-header">
			<input type="text" placeholder="Поиск..." class="search__input">
			<button class="search__submit"></button>
		</form>
	</div>
	<div class="container-fluid container-fluid_lightgray">
		<div class="container main-menu">
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
			<a href="" class="main-menu__item">НАШИ КОНТАКТЫ</a>
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
	<div class="container-fluid container-fluid_darkgray">
		<div class="container container_fix">
			<div class="container__col-left">
				<a href="" class="logo logo_light logo_in-footer">
					<img src="{{url('img/light-logo.png')}}" alt="">
				</a>
			</div>
			<div class="container__col-left footer-menu">
				<a href="" class="footer-menu__item">Меню</a>
				<a href="" class="footer-menu__item">Новости и акции</a>
				<a href="" class="footer-menu__item">Наши контакты</a>
				<a href="" class="footer-menu__item">Партнеры</a>
				<a href="" class="footer-menu__item">Вакансии</a>
				<a href="" class="footer-menu__item">BentoBar</a>
				<a href="" class="footer-menu__item">Условия доставки</a>
				<a href="" class="footer-menu__item">Доставка</a>
			</div>
			<div class="container__col-right social-buttons social-buttons_in-footer">
				<a href="" class="social-buttons__item social-buttons__item_vk"></a>
				<a href="" class="social-buttons__item social-buttons__item_tw"></a>
				<a href="" class="social-buttons__item social-buttons__item_lj"></a>
				<a href="" class="social-buttons__item social-buttons__item_ok"></a>
				<a href="" class="social-buttons__item social-buttons__item_gp"></a>
				<a href="" class="social-buttons__item social-buttons__item_fb"></a>
			</div>
		</div>
	</div>

	<!-- floating shoping cart -->
		<form class="floating-shoping-cart">
			<div class="floating-shoping-cart__user">
				<img src="{{url('img/login-icon.png')}}" alt="" class="floating-shoping-cart__icon">
				<a href="" class="floating-shoping-cart__login">ВХОД</a>
				<a href="" class="floating-shoping-cart__register">РЕГИСТРАЦИЯ</a>
			</div>
			<div class="floating-shoping-cart__title">
				<img src="{{url('img/cart.png')}}" alt="" class="floating-shoping-cart__icon">
				ВАША КОРЗИНА
			</div>
			<table class="floating-shoping-cart__items">
				<tr class="floating-shoping-cart__item">
					<td class="floating-shoping-cart__item-count"><input type="number" class="number number_small" name="" value="10"></td>
					<td class="floating-shoping-cart__item-name">Японский десерт "Маракуйя"</td>
					<td class="floating-shoping-cart__item-price">150грн</td>
					<td><a href="" class="floating-shoping-cart__item-remove"></a></td>
				</tr>
				<tr class="floating-shoping-cart__item">
					<td class="floating-shoping-cart__item-count"><input type="number" class="number number_small" name="" value="2"></td>
					<td class="floating-shoping-cart__item-name">Японский десерт "Маракуйя"</td>
					<td class="floating-shoping-cart__item-price">150грн</td>
					<td><a href="" class="floating-shoping-cart__item-remove"></a></td>
				</tr>		
			</table>
			<table class="cart-total">
				<tr>
					<td class="cart-total__label">Сумма</td>
					<td class="cart-total__value">300 грн</td>
				</tr>
				<tr>
					<td class="cart-total__label">Скидка</td>
					<td class="cart-total__value">-20 грн</td>
				</tr>
				<tr>
					<td class="cart-total__label">Доставка</td>
					<td class="cart-total__value">25 грн</td>
				</tr>
				<tr class="cart-total__result">
					<td class="cart-total__label">ИТОГО</td>
					<td class="cart-total__value">300 грн</td>
				</tr>						
			</table>
			<a href="" class="floating-shoping-cart__checkout button button_red button_small">ОФОРМИТЬ ЗАКАЗ</a>
		</form>
	<!-- floating shoping cart -->

	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
	<script src="{{url('js/fancybox/jquery.fancybox.min.js')}}"></script>
	<script src="{{url('js/flexslider/jquery.flexslider.min.js')}}"></script>
	<script src="{{url('js/main.js')}}"></script>
</body>
</html>