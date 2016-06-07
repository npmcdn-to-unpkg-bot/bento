<?php 
AdminSection::registerModel(App\Models\News\Article::class, function ($model) {
    $model->setTitle('Новости');
    $model->setAlias('news');
    // Display
    $model->onDisplay(function () {
        $display = AdminDisplay::table()->setColumns([
            AdminColumn::image('image')->setLabel('Картинка')->setWidth('90px'),
            AdminColumn::link('title')->setLabel('Заголовок')->setWidth('400px'),
        ]);
        $display->paginate(15);
        return $display;
    });
    // Create And Edit
    $model->onCreateAndEdit(function() {
        return $form = AdminForm::panel()->addBody(
            AdminFormElement::text('title', 'Заголовок')->required(),
            AdminFormElement::image('image', 'Картинка'),
            AdminFormElement::textarea('entry', 'Краткое содержание')->required(),
            AdminFormElement::ckeditor('content', 'Содержание')->required(),
            AdminFormElement::text('meta_title', 'meta-title'),
            AdminFormElement::textarea('meta_description', 'meta-description'),
            AdminFormElement::custom()->setCallback(function($model){
                makeSlug($model);
            })
        );
        return $form;
    });
})
    ->addMenuPage(App\Models\News\Article::class, 60)
    ->setUrl('admin/news')
    ->setIcon('fa fa-newspaper-o');