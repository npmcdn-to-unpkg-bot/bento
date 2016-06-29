@push('scripts')
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
@endpush
<div id="register" class="modal">
    <div class="row">
        <form class="row__col-8 row__col-mob-12 registration ajax-form" action="{{ url('register') }}" method="POST">
            {{csrf_field()}}
            <div class="registration__title">Регистрация нового пользователя</div>
            <div class="row">
                <div class="row__col-6 row__col-mob-12">
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
                <div class="row__col-6 row__col-mob-12">
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
                        <input id="birthday" name="birth_day" class="input input_100" placeholder="Дата рождения" value="{{old('birth_day')}}">
                    </div>
                    
                </div>
            </div>
            <button class="registration__button button button_red">ЗАРЕГЕСТРИРОВАТЬСЯ</button>
        </form>
        <div class="row__col-4 row__col-mob-12 reg-social reg-social_in-modal">
            <div class="reg-social__title">Связь с социальными сетями</div>
            @include('general.auth.social')
        </div>
    </div>
</div>
