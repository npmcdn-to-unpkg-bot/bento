<div class="modal modal_big">
    <div class="container">
        <form class="container__col-8 registration" method="POST" action="{{ url('register') }}">
        {{ csrf_field() }}
        <div class="registration__title">Регистрация нового пользователя</div>
        <div class="jus-cont">
            <input type="text" class="jus-cont__item registration__item input" name="first_name" value="{{old('first_name')}}" placeholder="Ваше имя">
            <input type="text" class="jus-cont__item registration__item input" name="email" value="{{old('email')}}" placeholder="Ваш e-mail">
            <input type="text" class="jus-cont__item registration__item input" name="last_name" value="{{old('last_name')}}" placeholder="Ваша фамилия">
            <input type="text" class="jus-cont__item registration__item input" name="password" placeholder="Ваш пароль">
            <input type="text" class="jus-cont__item registration__item input" name="phone" value="{{old('phone')}}" placeholder="Ваш телефон">
            <input type="text" class="jus-cont__item registration__item input" name="password_confirm" placeholder="Повторите Ваш пароль">
            <input type="text" class="jus-cont__item registration__item input" name="place" value="{{old('place')}}" placeholder="Адрес доставки">
            <input type="text" class="jus-cont__item registration__item input" name="trafic_source" value="{{old('trafic_source')}}" placeholder="Где вы о нас узнали?">
            <input type="text" class="jus-cont__item registration__item input" name="bento_card" value="{{old('bento_card')}}" placeholder="Карта Bento">
            <div class="date-picker jus-cont__item registration__item input">
                <select class="date-picker__item date-picker__day" name="" id="">
                    <option value="">число</option>
                    <option value="">01</option>
                    <option value="">02</option>
                    <option value="">03</option>
                    <option value="">04</option>
                    <option value="">05</option>
                </select>
                <select class="date-picker__item date-picker__month" name="" id="">
                    <option value="">месяц</option>
                    <option value="">январь</option>
                    <option value="">февраль</option>
                    <option value="">март</option>
                    <option value="">апрель</option>
                    <option value="">май</option>
                </select>
                <select class="date-picker__item date-picker__year" name="" id="">
                    <option value="">год рождения</option>
                    <option value="">1975</option>
                    <option value="">1976</option>
                    <option value="">1978</option>
                    <option value="">1979</option>
                    <option value="">1980</option>
                </select>
            </div>
        </div>
            <button class="registration__button button button_red">ЗАРЕГЕСТРИРОВАТЬСЯ</button>
        </form>
        <div class="container__col-4 reg-social reg-social_in-modal">
            <div class="reg-social__title">Связь с социальными сетями</div>
            <a href="" class="reg-social__item login-social-button login-social-button_vk login-social-button_big">Войти через Вконтакте</a>
            <a href="" class="reg-social__item login-social-button login-social-button_fb login-social-button_big">Войти через Facebook</a>
        </div>
    </div>
</div>
