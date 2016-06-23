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
    $model->onCreateAndEdit(function() use ($model) {
        $form = AdminForm::panel()->addBody(
            AdminFormElement::text('name', 'Название')->required(),
            AdminFormElement::image('image', 'Картинка')->required(),
            AdminFormElement::ckeditor('description', 'Описание'),
            AdminFormElement::textaddon('old_price', 'Cтарая цена')->setAddon('грн.')->placeAfter(),
            AdminFormElement::textaddon('price', 'Цена')->required()->setAddon('грн.')->placeAfter(),
            AdminFormElement::text('order', 'Порядок сортировки'),
            AdminFormElement::select('left_label_id', 'Левый лейбл')->setModelForOptions('App\Models\Label')->setDisplay('name'),
            AdminFormElement::select('right_label_id', 'Правый лейбл')->setModelForOptions('App\Models\Label')->setDisplay('name'),
            AdminFormElement::multiselect('categories', 'Категории')->setModelForOptions('App\Models\Category')->setDisplay('name'),
            AdminFormElement::text('meta_title', 'meta-title'),
            AdminFormElement::textarea('meta_description', 'meta-description'),
            AdminFormElement::text('slug', 'Название для ЧПУ')->unique()
        );

        $form->addItem(AdminFormElement::custom()
            ->setDisplay(function($product){

                if (old()) {
                    $old = old('ingredient');
                    foreach ($old['id'] as $key => $id){
                        $inputs[$id]['id'] = $id;
                        $inputs[$id]['weight'] = $old['weight'][$key];
                    }
                }else{
                    foreach ($product->ingredients as $ingredient){
                        $inputs[$ingredient->id]['id'] = $ingredient->id;
                        $inputs[$ingredient->id]['weight'] = $ingredient->pivot->weight;
                    }
                }
                $inputs[]=['id'=>'','weight'=>''];
                return view('admin.ingredients', ['inputs'=>$inputs]);
            })
            ->setCallback(function($product) use ($form, $model) {
                $inputs = Request::input('ingredient');
                $ingredients = [];
                foreach ($inputs['id'] as $key => $id)
                    if ($id != 0) $ingredients[$id]['weight'] = $inputs['weight'][$key];


                $model->created(function($model,$product) use ($form, $ingredients) {
                    $product = $form->getModel();
                    $product->ingredients()->sync($ingredients);
                });

                $model->updated(function($model,$product) use ($form, $ingredients) {
                    $product = $form->getModel();
                    $product->ingredients()->sync($ingredients);
                });

            }));

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
    ->addMenuPage(App\Models\Product::class, 10)
    ->setIcon('fa fa-shopping-basket');