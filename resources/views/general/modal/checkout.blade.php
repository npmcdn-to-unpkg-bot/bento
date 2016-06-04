<div id="checkout" class="modal" style="width: 580px;">
    <form class="ajax-form" method="POST" action="{{ url('order/fast') }}">
        {{ csrf_field() }}
        <div class="login__title">Быстрый заказ</div>
        <div class="row">
            <div class="row__col-6">
            <div class="offset_bottom_10">
                <input type="text" class="input input_100" placeholder="Имя" name="first_name" value="{{old("first_name")}}">
            </div>
            <div class="offset_bottom_10">
                <input type="text" class="input input_100" placeholder="Телефон" name="phone" value="{{old("phone")}}">
            </div>
            <input type="hidden" name="remember" value="1">
            <div class="offset_bottom_10">
                <button class="button button_red button_small input_100">Оформить</button>
            </div>
                
            </div>
            <div class="row__col-6">
                <div class="new-user">
                    <div class="new-user__title">Личный кабинет</div>
                    <div class="new-user__text">Хотите оформлять доставку еще быстрее?<br>Воспользуйтесь личным кабинетом!</div>
                    <a href="#login" class="fancybox new-user__link button button_gray button_small">Вход</a>
                </div>
            </div>
        </div>
    </form>
</div>