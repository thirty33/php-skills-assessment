<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Contracts\QuotesContract;
use App\Repositories\Quotes;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(QuotesContract::class, Quotes::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        
    }
}
