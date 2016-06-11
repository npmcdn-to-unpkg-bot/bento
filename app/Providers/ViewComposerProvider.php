<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use View;

class ViewComposerProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('*', function($view)
        {
            $view->with([
                'user' => auth()->user(),
                'cart' => \App\Models\Cart::get(),
                'comparelist' => \App\Models\Comparelist::get(),
                'wishlist' => \App\Models\Wishlist::get()
            ]);
        });
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
