<?php

namespace Rdhafiz\LaravelVueSpa;

use Illuminate\Support\ServiceProvider;

class LvsServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('command.rdhafiz.LaravelVueSpa', function ($app){
            return $app['Rdhafiz\LaravelVueSpa\Commands\LaravelVueSpa'];
        });
        $this->commands('command.rdhafiz.LaravelVueSpa');
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
