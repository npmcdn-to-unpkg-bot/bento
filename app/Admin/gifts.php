<?php 
AdminSection::registerModel(App\Models\Gift::class, function ($model) {
    $model->setTitle('Подарки');
    // Display
    $model->onDisplay(function () {
        $display = AdminDisplay::table()->setColumns([
            AdminColumn::text('id')->setLabel('id')->setWidth('50px'),
            AdminColumn::link('product.name')->setLabel('Подарок'),
            AdminColumn::text('start')->setLabel('от (грн)'),
        ]);
        $display->paginate(15);
        return $display;
    });
    // Create And Edit
    $model->onCreateAndEdit(function() {
        return $form = AdminForm::panel()->addBody(
            AdminFormElement::select('product_id', 'Подарок')->setModelForOptions('App\Models\Product')->setDisplay('name'),
            AdminFormElement::textaddon('start', 'Сумма покупки для получения подарка')->required()->setAddon('грн.')->placeAfter()
        );
        return $form;
    });

})  
    ->addMenuPage(App\Models\Gift::class, 46)
    ->setIcon('fa  fa-gift');