<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Observers\OrderObserver;
use App\Models\Order;

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
        if (config('app.env') === 'production') {
            \URL::forceScheme('https');
        }

        Order::observe(OrderObserver::class);
    }

    
}
