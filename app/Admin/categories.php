<?php 
AdminSection::registerModel(App\Models\Category::class, function ($model) {
    $model->setTitle('Категории');
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
        $form = AdminForm::panel()->addBody(
            AdminFormElement::text('name', 'Название')->required(),
            AdminFormElement::image('image', 'Картинка')->required(),
            AdminFormElement::text('order', 'Порядок'),
            AdminFormElement::text('slug', 'Название для ЧПУ')->unique(),
            AdminFormElement::text('meta_title', 'Meta title'),
            AdminFormElement::textarea('meta_description', 'Meta description')
        );
        
        $model->updated(function($m, $model) use ($form) {
            $model = $form->getModel();
            $model->slug = $model->slug ? $model->slug : str_slug($model->name);
            $model->save();
        });

        $model->created(function($m, $model) use ($form) {
            $model = $form->getModel();
            $model->slug = $model->slug ? $model->slug : str_slug($model->name);
            $model->save();
        });

        return $form;
    });
})
    ->addMenuPage(App\Models\Category::class, 20)
    ->setIcon('fa fa-folder');