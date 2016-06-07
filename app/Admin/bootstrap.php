<?php

function makeSlug ($model, $item) {
    $slug = str_slug($item->name ? $item->name : $item->title);
    $i = 1;
    $class = $model->getClass();
    while ( $class::where('slug', $slug)->first() )
        $slug = str_slug($item->name ? $item->name : $item->title) . '-' . $i++;

    $item->slug = $slug;
    $item->save();
}

// PackageManager::load('admin-default')
//    ->css('extend', resources_url('css/extend.css'));
