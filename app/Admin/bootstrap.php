<?php

// PackageManager::load('admin-default')
//    ->css('extend', resources_url('css/extend.css'));

AdminSection::registerModel(App\Models\Product::class, function ($model) {
    $model->setTitle('Товары');
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
            AdminFormElement::image('image', 'Картинка')->required(),
            AdminFormElement::ckeditor('description', 'Описание'),
            AdminFormElement::text('price', 'Цена')->required(),
            AdminFormElement::text('order', 'Порядок сортировки')->required()
            // $table->integer('left_label_id')->index();
            // $table->integer('right_label_id')->index();
        );
        return $form;
    });
})
    ->addMenuPage(App\Models\Product::class, 0)
    ->setIcon('fa fa-bank');