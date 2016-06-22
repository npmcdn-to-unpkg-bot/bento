<?php 
AdminSection::registerModel(App\Models\Review::class, function ($model) {
    $model->setTitle('Отзывы');
    // Display
    $model->onDisplay(function () {
        $display = AdminDisplay::table()->setColumns([
            AdminColumn::image('user.image'),
            AdminColumn::text('user.first_name')->setLabel('Имя'),
            AdminColumn::text('user.last_name')->setLabel('Фамилия'),
            AdminColumn::custom()->setLabel('Опубликовано')->setCallback(function($model){
                return $model->published ? 'Да' : 'Нет';
            }),
        ]);
        $display->paginate(15);
        return $display;
    });
    // Create And Edit
    $model->onEdit(function() {
        return $form = AdminForm::panel()->addBody(
            AdminFormElement::checkbox('published', 'Опубликовано'),
            AdminFormElement::textarea('text', 'Отзыв')->required()
        );
        return $form;
    });

})  
    ->addMenuPage(App\Models\Review::class, 80)
    ->setIcon('fa  fa-gift');