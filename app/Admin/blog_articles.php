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
    $model->onCreateAndEdit(function() use($model) {
        $form = AdminForm::panel()->addBody(
            AdminFormElement::text('title', 'Заголовок')->required(),
            AdminFormElement::image('image', 'Картинка'),
            AdminFormElement::textarea('entry', 'Краткое содержание')->required(),
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
    ->addMenuPage(App\Models\Blog\Article::class, 50)
    ->setUrl('admin/blog')
    ->setIcon('fa  fa-newspaper-o');