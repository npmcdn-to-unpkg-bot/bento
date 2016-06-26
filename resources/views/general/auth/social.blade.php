@push('scripts')
<script src="//ulogin.ru/js/ulogin.js"></script>
<script>
    function login_from_social (token) {
        var form = document.createElement('form');
        var _token = document.createElement('input');
        var uToken = document.createElement('input');
        form.appendChild(_token);
        form.appendChild(uToken);

        form.method = 'POST';
        form.action = '{{url('/ulogin')}}';

        _token.type = 'hidden';
        _token.name = '_token';
        _token.value = '{{csrf_token()}}';

        uToken.type = 'hidden';
        uToken.name = 'uToken';
        uToken.value = token;

        form.submit();
    }
</script>
@endpush
<div data-ulogin="display=buttons;fields=first_name,last_name,email,photo_big;providers=vk,facebook;hidden=;redirect_uri=;callback=login_from_social">
    <div data-uloginbutton="vkontakte" class="reg-social__item login-social-button login-social-button_vk login-social-button_big">Войти через Вконтакте</div>
    <div data-uloginbutton="facebook" class="reg-social__item login-social-button login-social-button_fb login-social-button_big">Войти через Facebook</div>
</div>