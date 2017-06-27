<?php

namespace ZFort\Seoable;

use Illuminate\Support\ServiceProvider;

class SeoableServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->registerResources();
        }

        $this->app->register(\Artesaos\SEOTools\Providers\SEOToolsServiceProvider::class);
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/seoable.php', 'seoable');
    }

    protected function registerResources()
    {
        // Config
        $this->publishes([
            __DIR__.'/../config/skeleton.php' => config_path('seoable.php'),
        ], 'config');

        // Translations
        $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'seoable');

        $this->publishes([
            __DIR__.'/../resources/lang' => resource_path('lang/vendor/seoable'),
        ], 'lang');
    }
}
