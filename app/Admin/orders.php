<?php 
AdminSection::registerModel(App\Models\Order::class, function ($model) {
    $model->setTitle('Заказы');
    // Display
    $model->onDisplay(function () {
        $display = AdminDisplay::table()->setColumns([
            AdminColumn::text('id')->setWidth('90px'),
            AdminColumn::datetime('created_at')->setLabel('Дата')->setFormat('d.m.Y G:i'),
            AdminColumn::text('user.email')->setLabel('E-mail'),
            AdminColumn::text('phone')->setLabel('Телефон'),
            AdminColumn::text('first_name')->setLabel('Имя'),
            AdminColumn::text('user.last_name')->setLabel('Фамилия'),
            AdminColumn::custom()->setCallback(function($order){
                return $order->count();
            })->setLabel('Товаров'),
            AdminColumn::custom()->setCallback(function($order) { 
                return $order->total(); 
            })->setLabel('Итог'),
            AdminColumn::text('payment_method')->setLabel('Способ оплаты'),
            AdminColumn::text('payed')->setLabel('Статус оплаты'),
            AdminColumn::text('status')->setLabel('Статус')
        ]);
        $display->paginate(15);
        return $display;
    });
    $model->onEdit(function() {
        return $form = AdminForm::panel()->addBody(
            AdminFormElement::radio('status', 'Статус заказа')->setSortable(false)->setOptions([
                'В обработке'                       => 'В обработке',
                'Принят'                            => 'Принят',
                'Приготовлен'                       => 'Приготовлен',
                'В пути'                            => 'В пути',
                'Доставлен'                         => 'Доставлен',
                'Не обработан (отклонен)'           => 'Не обработан (отклонен)'
            ]),
            AdminFormElement::textarea('comment', 'Коментарий к заказу')
        );
        return $form;
    });

    $model->updating(function($model,$order) {
        $order->updateStatus(Request::get('status'));
    });

})
    ->addMenuPage(App\Models\Order::class, 21)
    ->setIcon('fa fa-money');