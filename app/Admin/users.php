<?php 
AdminSection::registerModel(App\User::class, function ($model) {
    $model->setTitle('Пользователи');
    // Display
    $model->onDisplay(function () {
        $display = AdminDisplay::table()->setColumns([
            AdminColumn::link('id')->setLabel('id')->setWidth('50px'),
            AdminColumn::text('email')->setLabel('Email'),
            AdminColumn::text('first_name')->setLabel('Имя'),
            AdminColumn::text('last_name')->setLabel('Фамилия'),
            AdminColumn::text('phone')->setLabel('Телефон'),
            AdminColumn::datetime('birth_day')->setLabel('День рождения')->setFormat('d.m.Y'),

        ]);
        $display->paginate(15);
        return $display;
    });
    // Create And Edit
    $model->onEdit(function() {
        return $form = AdminForm::panel()->addBody(
            AdminFormElement::text('email', 'Email')->required()->setReadonly(true),
            AdminFormElement::text('first_name', 'Имя')->required(),
            AdminFormElement::text('last_name', 'Фамилия')->required(),
            AdminFormElement::date('birth_day', 'День рождения')->required(),
            AdminFormElement::text('phone', 'Телефон')->required(),
            AdminFormElement::text('bento_card', 'Карта bento'),
            AdminFormElement::text('trafic_source', 'Где он узнал о bento')->setReadonly(true)
        );
        return $form;
    });
})
    ->addMenuPage(App\User::class, 70)
    ->setIcon('fa  fa-user');