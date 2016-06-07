<?php 
AdminSection::registerModel(App\Models\Blog\Article::class, function ($model) {
    $model->setTitle('Блог');
    $model->setAlias('blog');
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
    ->addMenuPage(App\Models\Blog\Article::class, 50)
    ->setUrl('admin/blog')
    ->setIcon('fa  fa-newspaper-o');