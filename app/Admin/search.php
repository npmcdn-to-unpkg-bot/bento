<?php
AdminSection::registerModel(App\Models\Search::class, function ($model) {
    $model->setTitle('Поисковые запросы');
    $model->onDisplay(function () {
        $display = AdminDisplay::table()->setColumns([
            AdminColumn::text('q')->setLabel('Запрос'),
            AdminColumn::text('ip')->setLabel('ip')
        ])
        ->paginate(100);
        return $display;
    });
})
	->addMenuPage(App\Models\Search::class, 80)
    ->setIcon('fa fa-search');