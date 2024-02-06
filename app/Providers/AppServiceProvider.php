<?php

namespace App\Providers;


use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Wishlist;
use Gloudemans\Shoppingcart\Facades\Cart;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        
    }

    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
        

        

        View::composer('*', function ($view) {
            $wishlistCount = Wishlist::where('user_id', auth()->id())->count();
            $cartCount = count(Cart::content()->pluck('id')->unique());
            $view->with('wishlistCount', $wishlistCount)
                 ->with('cartCount', $cartCount);
        });
        

        
    }
}
