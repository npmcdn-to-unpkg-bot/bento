<?php
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
        $form = AdminForm::panel()->addBody(
            AdminFormElement::text('name', 'Название')->required(),
            AdminFormElement::image('image', 'Картинка')->required(),
            AdminFormElement::ckeditor('description', 'Описание'),
            AdminFormElement::textaddon('price', 'Цена')->required()->setAddon('грн.')->placeAfter(),
            AdminFormElement::text('order', 'Порядок сортировки')->required(),
            AdminFormElement::select('left_label_id', 'Левый лейбл')->setModelForOptions('App\Models\Label')->setDisplay('name'),
            AdminFormElement::select('right_label_id', 'Правый лейбл')->setModelForOptions('App\Models\Label')->setDisplay('name'),
            AdminFormElement::multiselect('categories', 'Категории')->setModelForOptions('App\Models\Category')->setDisplay('name')
        );

        $form->addItem(AdminFormElement::custom()
            ->setDisplay(function($model){

                if (old()) {
                    $old = old('ingredient');
                    foreach ($old['id'] as $key => $id){
                        $inputs[$id]['id'] = $id;
                        $inputs[$id]['weight'] = $old['weight'][$key];
                    }
                }else{
                    foreach ($model->ingredients as $ingredient){
                        $inputs[$ingredient->id]['id'] = $ingredient->id;
                        $inputs[$ingredient->id]['weight'] = $ingredient->pivot->weight;
                    }
                }
                $inputs[]=['id'=>'','weight'=>''];
                return view('admin.ingredients', ['inputs'=>$inputs]);
            })
            ->setCallback(function($model){
                $inputs = Request::input('ingredient');
                foreach ($inputs['id'] as $key => $id)
                    $ingredients[$id]['weight'] = $inputs['weight'][$key];

                $model->ingredients()->sync($ingredients);
            }));

        return $form;
    });
})
    ->addMenuPage(App\Models\Product::class, 10)
    ->setIcon('fa fa-bank');