<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;

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
    // Aktifkan Bootstrap pagination
    Paginator::useBootstrap();

    // Komposer view untuk cart
    view()->composer('*', function ($view) {
        $cartItemCount = auth()->check()
            ? \App\Models\Cart::where('user_id', auth()->id())->sum('quantity')
            : 0;

        $view->with('cartItemCount', $cartItemCount);
    });
}

}
