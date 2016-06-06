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
                return $order->sum(); 
            })->setLabel('Сумма'),
        ]);
        $display->paginate(15);
        return $display;
    });
    // Create And Edit
    $model->onCreateAndEdit(function() {
        return $form = AdminForm::panel()->addBody(

        );
        return $form;
    });
})
    ->addMenuPage(App\Models\Order::class, 20)
    ->setIcon('fa fa-money');