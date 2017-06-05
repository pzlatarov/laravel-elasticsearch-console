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
        $this->mergeConfigFrom(__DIR__.'/../config/elasticsearch_console.php','elasticsearch_console');
        $this->loadViewsFrom(__DIR__.'/../resources/views','es-console');
    }
}
