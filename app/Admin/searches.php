<?php
AdminSection::registerModel(App\Models\Search::class, function ($model) {
    $model->setTitle('Поисковые запросы');
    $model->onDisplay(function () {
        $display = AdminDisplay::table()->setColumns([
            AdminColumn::text('q')->setLabel('Запрос'),
            AdminColumn::custom()->setCallback( function ($model) {
                $class = get_class($model);
                return $class::where('q',$model->q)->count();
            })
        ])
        ->setApply(function($query){
            $query->groupby('q')->distinct();
        })
        ->paginate(100);
        return $display;
    });
})
	->addMenuPage(App\Models\Search::class, 80)
    ->setIcon('fa fa-search');