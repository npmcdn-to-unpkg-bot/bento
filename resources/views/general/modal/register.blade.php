<script>
    $(document).ready(function(){
        @if (Request::is('register'))
        $.fancybox('#register',{
            closeBtn: false,
            helpers: { 
                overlay : {closeClick: false}
            },
            keys: {
                close: false
            }
        })
        @endif
    })
</script>
<div id="register" class="modal" style="width: 980px;">
    <div class="row">
        <form class="row__col-8 registration ajax-form" action="{{ url('register') }}" method="POST">
            {{csrf_field()}}
            <div class="registration__title">Регистрация нового пользователя</div>
            <div class="row">
                <div class="row__col-6">
                    <div class="offset_bottom_10">
                        <input type="text" class="input input_100" name="first_name" value="{{old('first_name')}}" placeholder="Ваше имя">
                    </div>
                    <div class="offset_bottom_10">
                        <input type="text" class="input input_100" name="last_name" value="{{old('last_name')}}" placeholder="Ваша фамилия">
                    </div>
                    <div class="offset_bottom_10">
                        <input type="text" class="input input_100" name="phone" value="{{old('phone')}}" placeholder="Ваш телефон">
                    </div>
                    <div class="offset_bottom_10">
                        <input type="text" class="input input_100" name="place" value="{{old('place')}}" placeholder="Адрес доставки">
                    </div>
                    <div class="offset_bottom_10">
                        <input type="text" class="input input_100" name="bento_card" value="{{old('bento_card')}}" placeholder="Карта Bento">
                    </div>
                </div>
                <div class="row__col-6">
                    <div class="offset_bottom_10">
                        <input type="text" class="input input_100" name="email" value="{{old('email')}}" placeholder="Ваш e-mail">
                    </div>
                    <div class="offset_bottom_10">
                        <input type="password" class="input input_100" name="password" placeholder="Ваш пароль">
                    </div>
                    <div class="offset_bottom_10">
                        <input type="password" class="input input_100" name="password_confirmation" placeholder="Повторите Ваш пароль">
                    </div>
                    <div class="offset_bottom_10">
                        <input type="text" class="input input_100" name="trafic_source" value="{{old('trafic_source')}}" placeholder="Где вы о нас узнали?">
                    </div>
                    <div class="offset_bottom_10">
                        <div class="date-picker input input_100">
                            <select class="date-picker__item date-picker__day" name="" id="">
                                <option value="">число</option>
                                @for ($i=1;$i<=31;$i++)
                                <option value="{{$i}}">{{$i}}</option>
                                @endfor
                            </select>
                            <select class="date-picker__item date-picker__month" name="" id="">
                                <option value="0">месяц</option>
                                <option value="1">январь</option>
                                <option value="2">февраль</option>
                                <option value="3">март</option>
                                <option value="4">апрель</option>
                                <option value="5">май</option>
                                <option value="6">июнь</option>
                                <option value="7">июль</option>
                                <option value="8">август</option>
                                <option value="9">сентябрь</option>
                                <option value="10">октябрь</option>
                                <option value="11">ноябрь</option>
                                <option value="12">декабрь</option>
                            </select>
                            <select class="date-picker__item date-picker__year" name="" id="">
                                <option value="">год рождения</option>
                                @for ($i=Carbon\Carbon::now()->year;$i>=1900;$i--)
                                <option value="{{$i}}">{{$i}}</option>
                                @endfor
                            </select>
                        </div>
                    </div>
                    
                </div>
            </div>
            <button class="registration__button button button_red">ЗАРЕГЕСТРИРОВАТЬСЯ</button>
        </form>
        <div class="row__col-4 reg-social reg-social_in-modal">
            <div class="reg-social__title">Связь с социальными сетями</div>
            <a href="" class="reg-social__item login-social-button login-social-button_vk login-social-button_big">Войти через Вконтакте</a>
            <a href="" class="reg-social__item login-social-button login-social-button_fb login-social-button_big">Войти через Facebook</a>
        </div>
    </div>
</div>
