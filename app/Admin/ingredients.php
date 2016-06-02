<?php 
AdminSection::registerModel(App\Models\Ingredient::class, function ($model) {
    $model->setTitle('Ингредиенты');
    // Display
    $model->onDisplay(function () {
        $display = AdminDisplay::table()->setColumns([
            AdminColumn::image('image')->setLabel('Картинка')->setWidth('90px'),
            AdminColumn::link('name')->setLabel('Название')->setWidth('400px'),
            AdminColumn::text('proteins')->setLabel('Белки')->setWidth('auto'),
            AdminColumn::text('fats')->setLabel('Жиры')->setWidth('auto'),
            AdminColumn::text('carbs')->setLabel('Углеводы')->setWidth('auto'),
            AdminColumn::text('kcal')->setLabel('Килло Калории')->setWidth('auto'),
        ]);
        $display->paginate(15);
        return $display;
    });
    // Create And Edit
    $model->onCreateAndEdit(function() {
        return $form = AdminForm::panel()->addBody(
            AdminFormElement::text('name', 'Название')->required(),
            AdminFormElement::image('image', 'Картинка'),
            AdminFormElement::textaddon('proteins', 'Белки')->required()->setAddon('грамм')->placeAfter(),
            AdminFormElement::textaddon('fats', 'Жиры')->required()->setAddon('грамм')->placeAfter(),
            AdminFormElement::textaddon('carbs', 'Углеводы')->required()->setAddon('грамм')->placeAfter(),
            AdminFormElement::textaddon('kcal', 'Калорийность')->required()->setAddon('ккал.')->placeAfter()
        );
        return $form;
    });
})
    ->addMenuPage(App\Models\Ingredient::class, 30)
    ->setIcon('fa fa-flask');