<?php 
AdminSection::registerModel(App\Models\Page::class, function ($model) {
    $model->setTitle('Страницы');
    // Display
    $model->onDisplay(function () {
        $display = AdminDisplay::table()->setColumns([
            AdminColumn::link('title')->setLabel('Заголовок')->setWidth('400px'),
        ]);
        $display->paginate(15);
        return $display;
    });
    // Create And Edit
    $model->onCreateAndEdit(function() {
        return $form = AdminForm::panel()->addBody(
            AdminFormElement::text('title', 'Заголовок')->required(),
            AdminFormElement::text('slug', 'Slug')->required(),
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
    ->addMenuPage(App\Models\Page::class, 65)
    ->setIcon('fa  fa-file-o');
