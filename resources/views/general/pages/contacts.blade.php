@extends(Agent::isMobile() ? 'general.layout.mobile' : 'general.layout.desktop')

@section('content')

	<div class="container">
		<div class="title">
			<div class="title__text">
				КОНТАКТЫ
			</div>
		</div>
		<div class="contact-info jus-cont">
			<div class="contact-info__item jus-cont__item">
				<img src="img/phone.png" alt="">
				(048) 77-55-000
			</div>
			<div class="contact-info__item jus-cont__item">
				<img src="img/place-marker.png" alt="">
				г.Одесса ул. Днепропетровская дорога,120
			</div>
			<div class="contact-info__item jus-cont__item">
				<img src="img/envelope.png" alt="">
				info@bento.com.ua
			</div>
		</div>
		<form class="contact-form jus-cont">
			<div class="contact-form__title">ОСТАВИТЬ ЗАЯВКУ</div>
			<input type="text" name="" placeholder="Ваше имя" class="jus-cont__item contact-form__item input">
			<input type="text" name="" placeholder="Ваш телефон" class="jus-cont__item contact-form__item input">
			<input type="text" name="" placeholder="Ваш e-mail" class="jus-cont__item contact-form__item input">
			<button class="jus-cont__item contact-form__item button button_red">ОТПРАВИТЬ</button>
		</form>
		<script type="text/javascript" charset="utf-8" src="https://api-maps.yandex.ru/services/constructor/1.0/js/?sid=xxbY-qdWgPk6M2gTz3oGOSCAacenq4Sw&width=1150&height=650&lang=ru_RU&sourceType=constructor"></script>
	</div>
	@include('general.block.advantages')


@endsection
