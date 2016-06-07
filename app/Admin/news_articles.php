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
            AdminFormElement::ckeditor('content', 'Содержание')->required()
        );
        return $form;
    });
    $model->creating(function($model, $article) {
        makeSlug($model, $article);
    });
    $model->updating(function($model, $article) {
        makeSlug($model, $article);
    });
})
    ->addMenuPage(App\Models\News\Article::class, 60)
    ->setUrl('admin/news')
    ->setIcon('fa fa-newspaper-o');