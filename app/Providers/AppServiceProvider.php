<?php

namespace App\Providers;

use App\Models\CartItem;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        if ($this->app->environment('production')) {
            URL::forceScheme('https');
        }


        View::composer('*', function ($view) {
            $cartCount = 0;

            if (Auth::check()) {
                // Logged in: count items by user_id
                $cartCount = CartItem::query()->where('cart_id', Auth::id())->sum('quantity');
            } else {
                // Guest: count items by session_id
                $cartCount = 0;
            }

            $view->with('cartCount', $cartCount);
        });
    }
}
