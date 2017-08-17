<?php

namespace MadWeb\Seoable\Test;

use Illuminate\Support\ServiceProvider;

class TestServiceProvider extends ServiceProvider
{
    protected $defer = true;

    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        $this->app->instance('path.lang', __DIR__ . DIRECTORY_SEPARATOR . 'lang');
    }
}
