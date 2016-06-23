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
        $form = AdminForm::panel()->addBody(
            AdminFormElement::text('title', 'Заголовок')->required(),
            AdminFormElement::text('slug', 'Slug')->required(),
            AdminFormElement::ckeditor('content', 'Содержание')->required(),
            AdminFormElement::text('meta_title', 'meta-title'),
            AdminFormElement::textarea('meta_description', 'meta-description'),
            AdminFormElement::text('slug', 'Название для ЧПУ')->unique()
        );

        $model->updated(function($m, $model) use ($form) {
            $model = $form->getModel();
            $model->slug = $model->slug ? $model->slug : str_slug($model->title);
            $model->save();
        });

        $model->created(function($m, $model) use ($form) {
            $model = $form->getModel();
            $model->slug = $model->slug ? $model->slug : str_slug($model->title);
            $model->save();
        });
        
        return $form;
    });

})  
    ->addMenuPage(App\Models\Page::class, 65)
    ->setIcon('fa  fa-file-o');
