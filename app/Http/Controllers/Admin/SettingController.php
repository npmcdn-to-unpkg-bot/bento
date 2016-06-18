<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use SleepingOwl\Admin\Http\Controllers\AdminController;
use App\Models\Setting;
use AdminFormElement;
use AdminForm;
use App\Http\Forms\FormSettings;

class SettingController extends AdminController
{
	public function index (){

		$form = new FormSettings;
        $form
		    ->setModelClass(Setting::class)
		    ->addBody(
		    	AdminFormElement::textaddon('earn_points', 'Количество потраченных гривен для получения 1 балла')
		    		->setModel(Setting::getModel('earn_points'))
		    		->setAddon('грн.')->placeAfter(),
		    	AdminFormElement::textaddon('spend_points', 'Количество получаемых гривен за 1 балл')
		    		->setModel(Setting::getModel('spend_points'))
		    		->setAddon('грн.')->placeAfter(),

		    	AdminFormElement::html('<hr>'),

		    	AdminFormElement::textaddon('delivery_price', 'Цена доставки')
		    		->setModel(Setting::getModel('delivery_price'))
		    		->setAddon('грн.')->placeAfter(),
		    	AdminFormElement::textaddon('free_delivery_order_sum', 'Сумма заказа для бесплатной доставки')
		    		->setModel(Setting::getModel('free_delivery_order_sum'))
		    		->setAddon('грн.')->placeAfter(),

		    	AdminFormElement::html('<hr>'),

		        AdminFormElement::multiselect('recommendations', 'Рекомендованые товары')
		            ->setModel(Setting::getModel('recommendations'))
		            ->setModelForOptions(\App\Models\Product::class)
		            ->setDisplay('name'),

		    	AdminFormElement::html('<hr>'),

		        AdminFormElement::multiselect('ingredient_filters', 'Ингредиенты в фильтре')
		            ->setModel(Setting::getModel('ingredient_filters'))
		            ->setModelForOptions(\App\Models\Ingredient::class)
		            ->setDisplay('name')
		    )
		    ->setAction(route('admin.settings'))
        	->initialize();

	    return $this->renderContent($form);
	}

	public function store (Request $request){
		foreach ($request->except(['_token', '_redirectBack', 'next_action']) as $name => $value) {
			$setting = Setting::firstOrNew([ 'name' => $name ]);
			$setting->value = is_array($value) ? json_encode($value) : $value;
			$setting->save();
		}
		return back();
	}

}
