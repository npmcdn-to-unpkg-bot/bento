<?php

function makeSlug ($model) {
	$name = Request::get('name') ? Request::get('name') : Request::get('title');
    $slug = str_slug($name);
    $i = 1;
    while ( get_class($model)::where('slug', $slug)->first() )
        $slug = str_slug($name) . '-' . $i++;

    $model->slug = $slug;
}

// PackageManager::load('admin-default')
//    ->css('extend', resources_url('css/extend.css'));
