<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
{
    view()->composer('*', function ($view) {
        $cartItemCount = auth()->check()
            ? \App\Models\Cart::where('user_id', auth()->id())->sum('quantity')
            : 0;

        $view->with('cartItemCount', $cartItemCount);
    });
}

}
