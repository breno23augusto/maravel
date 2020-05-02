<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\MarvelApi;
use App\Services\HttpLaravel;
use Carbon\Carbon;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {

        $this->app->bind(MarvelApi::class, function ($app) {
            return new MarvelApi(new HttpLaravel, Carbon::now()->timestamp);
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
