<?php

Route::get('', ['as' => 'admin.dashboard', function () {
	$content = 'Define your dashboard here.';
	return AdminSection::view($content, 'Dashboard');
}]);

Route::get('settings', [
	'as' => 'admin.settings',
	'uses' => '\App\Http\Controllers\Admin\SettingController@index'
]);
Route::post('settings', [
	'as' => 'admin.settings', 
	'uses' => '\App\Http\Controllers\Admin\SettingController@store'
]);

Route::get('information', ['as' => 'admin.information', function () {
	$content = 'Define your information here.';
	return AdminSection::view($content, 'Information');
}]);

