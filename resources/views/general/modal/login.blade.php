<script>
    $(document).ready(function(){
        @if (Request::is('login')) $.fancybox('#login') @endif
    })
</script>
<div id="login" class="modal" style="width: 760px;">
    <div class="row">
        <form class="row__col-8 login login_or-register login_in-modal ajax-form" method="POST" action="{{ url('login') }}">
            {{ csrf_field() }}
            <div class="login__title">Авторизация</div>
            <div class="row">
                <div class="row__col-6">
                <div class="offset_bottom_10">
                    <input type="text" class="input input_100" placeholder="Ваш e-mail" name="email" value="{{old("email")}}">
                </div>
                <div class="offset_bottom_10">
                    <input type="password" class="input input_100" placeholder="Ваш пароль" name="password">
                </div>
                <input type="hidden" name="remember" value="1">
                <div class="offset_bottom_10">
                    <button class="button button_red button_small input_100">Войти</button>
                </div>
                <div class="offset_bottom_10">
                    <a href="{{ url('password/reset') }}" class="input_100 login__forgot">Забыли пароль?</a>
                </div>
                    
                </div>
                <div class="row__col-6">
                    <div class="offset_bottom_10">
                        <a href="" class="input_100 login-social-button_vk login-social-button">Войти через Вконтакте</a>
                    </div>
                    <div class="offset_bottom_10">
                        <a href="" class="input_100 login-social-button_fb login-social-button">Войти через Facebook</a>
                    </div>
                </div>
            </div>
        </form>
        <div class="row__col-right">
            <div class="new-user">
                <div class="new-user__title">Новый пользователь</div>
                <div class="new-user__text">Еще нет своей учетной записи?<br>Зарегестрируйтесь!</div>
                <a href="#register" class="fancybox new-user__link button button_gray button_small">Регистрация</a>
            </div>
        </div>
    </div>
</div>