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

        // Database
        if (! class_exists('CreateSeoTables')) {
            // Publish the migration
            $timestamp = date('Y_m_d_His', time());
            $this->publishes([
                __DIR__.'/../database/migrations/create_seo_tables.php.stub' => $this->app->databasePath().'/migrations/'.$timestamp.'_create_seo_tables.php',
            ], 'migrations');
        }

        // Translations
        $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'seoable');

        $this->publishes([
            __DIR__.'/../resources/lang' => resource_path('lang/vendor/seoable'),
        ], 'lang');
    }
}
