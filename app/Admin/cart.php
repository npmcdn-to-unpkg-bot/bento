<?php 
AdminSection::registerModel(App\Models\Cart::class, function ($model) {
    $model->setTitle('Брошеные корзины');
    // Display
    $model->onDisplay(function () {
        $display = AdminDisplay::table()->setColumns([
            AdminColumn::datetime('created_at')->setLabel('Дата')->setFormat('d.m.Y G:i'),
            AdminColumn::text('user.email')->setLabel('E-mail'),
            AdminColumn::text('user.phone')->setLabel('Телефон'),
            AdminColumn::text('user.first_name')->setLabel('Имя'),
            AdminColumn::text('user.last_name')->setLabel('Фамилия')
        ])
        ->setApply(function($query){
            $query->has('user');
        })
        ->paginate(15);
        return $display;
    });
    $model->onEdit(function() {
        $form = AdminForm::panel()->addBody(
            AdminFormElement::custom()->setDisplay(function($cart){
                return view('admin.cart',[
                    'cart'=>$cart
                ]);
            })
        );
        return $form;
    });

})
    ->addMenuPage(App\Models\Cart::class, 51)
    ->setIcon('fa fa-shopping-cart');