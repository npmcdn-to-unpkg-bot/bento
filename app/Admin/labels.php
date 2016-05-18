<?php 
AdminSection::registerModel(App\Models\Label::class, function ($model) {
    $model->setTitle('Лейблы');
    // Display
    $model->onDisplay(function () {
        $display = AdminDisplay::table()->setColumns([
            AdminColumn::image('image')->setLabel('Картинка')->setWidth('90px'),
            AdminColumn::link('name')->setLabel('Название')->setWidth('400px'),
        ]);
        $display->paginate(15);
        return $display;
    });
    // Create And Edit
    $model->onCreateAndEdit(function() {
        return $form = AdminForm::panel()->addBody(
            AdminFormElement::text('name', 'Название')->required(),
            AdminFormElement::image('image', 'Картинка')->required()
        );
        return $form;
    });
})
    ->addMenuPage(App\Models\Label::class, 40)
    ->setIcon('fa fa-bank');