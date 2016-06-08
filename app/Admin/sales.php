<?php 
AdminSection::registerModel(App\Models\Sale::class, function ($model) {
    $model->setTitle('Скидки');
    // Display
    $model->onDisplay(function () {
        
        $display = AdminDisplay::table();

        $display->setApply(function ($query) {
            $query->orderBy('order', 'asc');
        });

        $display->setHtmlAttribute('class', 'table-bordered table-hover');

        $display->setColumns([
            AdminColumn::order()
                ->setLabel('Приоритет')
                ->setWidth('100px')
                ->setHtmlAttribute('class', 'text-center'),
            AdminColumn::text('id')->setLabel('id')->setWidth('50px'),
            AdminColumn::link('name')->setLabel('Название скидки'),
            AdminColumn::text('value')->setLabel('%')
        ]);

        $display->paginate(15);
        return $display;
    });
    // Create And Edit
    $model->onCreateAndEdit(function() {
        return $form = AdminForm::panel()->addBody(
            AdminFormElement::text('name', 'Название скидки')->required(),
            AdminFormElement::time('start', 'Расписание: начало')->setFormat('H:i')->setDefaultValue('00:00'),
            AdminFormElement::time('end', 'конец')->setFormat('H:i')->setDefaultValue('00:00'),
            AdminFormElement::checkbox('stackable', 'Суммируется с другими скидками')->setDefaultValue(true),
            AdminFormElement::text('value', 'Скидка в %'),
            AdminFormElement::multiselect('users', 'Пользователи')->setModelForOptions('App\User')->setDisplay('email')->setHelpText('Оставьте пустым если скидка действует для всех пользователей'),
            AdminFormElement::multiselect('products', 'Товары')->setModelForOptions('App\Models\Product')->setDisplay('name')->setHelpText('Оставьте пустым если скидка действует для всех товаров'),
            AdminFormElement::text('order', 'Порядок')->setReadonly(true)
        );
        return $form;
    });
})
    ->addMenuPage(App\Models\Sale::class, 45)
    ->setIcon('fa  fa-percent');