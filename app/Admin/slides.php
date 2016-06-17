<?php 
AdminSection::registerModel(App\Models\Slide::class, function ($model) {
    $model->setTitle('Слайды');
    // Display
    $model->onDisplay(function () {
        $display = AdminDisplay::table()->setColumns([
            AdminColumn::image('image')->setLabel('Картинка'),
            AdminColumn::link('title')->setLabel('Заголовок'),
        ]);
        $display->paginate(15);
        return $display;
    });
    // Create And Edit
    $model->onCreateAndEdit(function() {
        $effects = [
            'fadeIn'                =>       'fadeIn',
            'fadeInDown'            =>       'fadeInDown',
            'fadeInDownBig'         =>       'fadeInDownBig',
            'fadeInLeft'            =>       'fadeInLeft',
            'fadeInLeftBig'         =>       'fadeInLeftBig',
            'fadeInRight'           =>       'fadeInRight',
            'fadeInRightBig'        =>       'fadeInRightBig',
            'fadeInUp'              =>       'fadeInUp',
            'fadeInUpBig'           =>       'fadeInUpBig',
            'fadeOut'               =>       'fadeOut',
            'fadeOutDown'           =>       'fadeOutDown',
            'fadeOutDownBig'        =>       'fadeOutDownBig',
            'fadeOutLeft'           =>       'fadeOutLeft',
            'fadeOutLeftBig'        =>       'fadeOutLeftBig',
            'fadeOutRight'          =>       'fadeOutRight',
            'fadeOutRightBig'       =>       'fadeOutRightBig',
            'fadeOutUp'             =>       'fadeOutUp',
            'fadeOutUpBig'          =>       'fadeOutUpBig',
            'bounce'                =>       'bounce',
            'flash'                 =>       'flash',
            'pulse'                 =>       'pulse',
            'rubberBand'            =>       'rubberBand',
            'shake'                 =>       'shake',
            'headShake'             =>       'headShake',
            'swing'                 =>       'swing',
            'tada'                  =>       'tada',
            'wobble'                =>       'wobble',
            'jello'                 =>       'jello',
            'bounceIn'              =>       'bounceIn',
            'bounceInDown'          =>       'bounceInDown',
            'bounceInLeft'          =>       'bounceInLeft',
            'bounceInRight'         =>       'bounceInRight',
            'bounceInUp'            =>       'bounceInUp',
            'bounceOut'             =>       'bounceOut',
            'bounceOutDown'         =>       'bounceOutDown',
            'bounceOutLeft'         =>       'bounceOutLeft',
            'bounceOutRight'        =>       'bounceOutRight',
            'bounceOutUp'           =>       'bounceOutUp',
            'flipInX'               =>       'flipInX',
            'flipInY'               =>       'flipInY',
            'flipOutX'              =>       'flipOutX',
            'flipOutY'              =>       'flipOutY',
            'lightSpeedIn'          =>       'lightSpeedIn',
            'lightSpeedOut'         =>       'lightSpeedOut',
            'rotateIn'              =>       'rotateIn',
            'rotateInDownLeft'      =>       'rotateInDownLeft',
            'rotateInDownRight'     =>       'rotateInDownRight',
            'rotateInUpLeft'        =>       'rotateInUpLeft',
            'rotateInUpRight'       =>       'rotateInUpRight',
            'rotateOut'             =>       'rotateOut',
            'rotateOutDownLeft'     =>       'rotateOutDownLeft',
            'rotateOutDownRight'    =>       'rotateOutDownRight',
            'rotateOutUpLeft'       =>       'rotateOutUpLeft',
            'rotateOutUpRight'      =>       'rotateOutUpRight',
            'hinge'                 =>       'hinge',
            'rollIn'                =>       'rollIn',
            'rollOut'               =>       'rollOut',
            'zoomIn'                =>       'zoomIn',
            'zoomInDown'            =>       'zoomInDown',
            'zoomInLeft'            =>       'zoomInLeft',
            'zoomInRight'           =>       'zoomInRight',
            'zoomInUp'              =>       'zoomInUp',
            'zoomOut'               =>       'zoomOut',
            'zoomOutDown'           =>       'zoomOutDown',
            'zoomOutLeft'           =>       'zoomOutLeft',
            'zoomOutRight'          =>       'zoomOutRight',
            'zoomOutUp'             =>       'zoomOutUp',
            'slideInDown'           =>       'slideInDown',
            'slideInLeft'           =>       'slideInLeft',
            'slideInRight'          =>       'slideInRight',
            'slideInUp'             =>       'slideInUp',
            'slideOutDown'          =>       'slideOutDown',
            'slideOutLeft'          =>       'slideOutLeft',
            'slideOutRight'         =>       'slideOutRight',
            'slideOutUp'            =>       'slideOutUp'
        ];
        return $form = AdminForm::panel()->addBody(
            AdminFormElement::image('image', 'Картинка')->required(),
            AdminFormElement::columns()
                ->addColumn(function () use ($effects) {
                    return [
                        AdminFormElement::html('<h4>Заголовок</h4>'),
                        AdminFormElement::text('title', 'Текст')->required(),
                        AdminFormElement::select('title_effect', 'Эффект')->setOptions($effects)->setSortable(false),
                        AdminFormElement::textaddon('title_time', 'Время появления')->setAddon('мсек.')->placeAfter()
                    ];
                })
                ->addColumn(function () use ($effects) {
                    return [
                        AdminFormElement::html('<h4>Текст</h4>'),
                        AdminFormElement::text('text', 'Текст')->required(),
                        AdminFormElement::select('text_effect', 'Эффект')->setOptions($effects)->setSortable(false),
                        AdminFormElement::textaddon('text_time', 'Время появления')->setAddon('мсек.')->placeAfter()
                    ];
                })
                ->addColumn(function () use ($effects) {
                    return [
                        AdminFormElement::html('<h4>Кнопка</h4>'),
                        AdminFormElement::text('button', 'Текст'),
                        AdminFormElement::select('button_effect', 'Эффект')->setOptions($effects)->setSortable(false),
                        AdminFormElement::textaddon('button_time', 'Время появления')->setAddon('мсек.')->placeAfter()
                    ];
                }),
            AdminFormElement::text('href','Ссылка')
        );
        return $form;
    });
})
    ->addMenuPage(App\Models\Slide::class, 63)
    ->setIcon('fa fa-desktop');