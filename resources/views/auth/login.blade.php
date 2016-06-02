<div class="modal modal_small">
    <div class="container">
        <form class="container__col-left login login_or-register login_in-modal" metho="POST" action="{{ url('login') }}">
            {{ csrf_field() }}
            <div class="login__title">Авторизация</div>
            <div class="jus-cont">
                <input type="text" class="input jus-cont__item login__item" placeholder="Ваш e-mail" name="email" value="{{old("email")}}">
                <a href="" class="jus-cont__item login__item login-social-button_vk login-social-button">Войти через Вконтакте</a>
                <input type="password" class="input jus-cont__item login__item" placeholder="Ваш пароль" name="password">
                <a href="" class="jus-cont__item login__item login-social-button_fb login-social-button">Войти через Facebook</a>
                <input type="hidden" name="remember" value="1">
                <button class="button button_red button_small jus-cont__item login__item">Войти</button>
                <br>
                <a href="{{ url('password/reset') }}" class="jus-cont__item login__item login__forgot">Забыли пароль?</a>
            </div>
        </form>
        <div class="container__col-right">
            <div class="new-user">
                <div class="new-user__title">Новый пользователь</div>
                <div class="new-user__text">Еще нет своей учетной записи?<br>Зарегестрируйтесь!</div>
                <a href="" class="new-user__link button button_gray button_small">Регистрация</a>
            </div>
        </div>
    </div>
</div>