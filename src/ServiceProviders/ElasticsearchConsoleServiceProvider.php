<?php

namespace Pzlatarov\ElasticsearchConsole\ServiceProviders;

use Illuminate\Support\ServiceProvider;

class ElasticsearchConsoleServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__.'/../routes/web.php');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        if ($this->app instanceof LaravelApplication && $this->app->runningInConsole()) {
            $this->publishes([__DIR__.'/../config/elasticsearch_console.php' => config_path('elasticsearch_console.php')]);
        }
        $this->mergeConfigFrom(__DIR__.'/../config/elasticsearch_console.php','elasticsearch_console');
        $this->loadViewsFrom(__DIR__.'/../resources/views','es-console');
    }
}
