<?php 
AdminSection::registerModel(App\Models\Blog\Article::class, function ($model) {
    $model->setTitle('Блог');
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
            AdminFormElement::image('image', 'Картинка'),
            AdminFormElement::textarea('entry', 'Краткое содержание')->required(),
            AdminFormElement::ckeditor('content', 'Содержание')->required()
        );
        return $form;
    });
})
    ->addMenuPage(App\Models\Blog\Article::class, 50)
    ->setIcon('fa fa-bank');