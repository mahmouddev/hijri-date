<?php

namespace Mahmouddev\HijriDate\Laravel;

use Illuminate\Support\ServiceProvider;
use Mahmouddev\HijriDate\HijriDate;

class HijriDateServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
       //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->prepareResources();
        $this->registerHijriDate();
    }

    /**
     * Prepare the package resources.
     *
     * @return void
     */
    protected function prepareResources()
    {
        // Publish config
        $config = realpath(__DIR__.'/../config/config.php');

        $this->mergeConfigFrom($config, 'mahmouddev.hijri-date');

        $this->publishes([
            $config => config_path('mahmouddev.hijri-date.php'),
        ], 'config');

    }

    /**
     * Register hijri date.
     *
     * @return void
     */
    protected function registerHijriDate()
    {
        $this->app['mahmouddev.hijridate'] = $this->app->share(function ($app) {

            return new HijriDate();
        });
    }
}
