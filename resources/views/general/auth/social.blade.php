@push('scripts')
<script src="//ulogin.ru/js/ulogin.js"></script>

@endpush
<div data-ulogin="display=buttons;fields=first_name,last_name,email,photo_big;providers=vk,facebook;hidden=;redirect_uri=;callback=login_from_social">
    <div data-uloginbutton="vkontakte" class="reg-social__item login-social-button login-social-button_vk login-social-button_big">Войти через Вконтакте</div>
    <div data-uloginbutton="facebook" class="reg-social__item login-social-button login-social-button_fb login-social-button_big">Войти через Facebook</div>
</div>