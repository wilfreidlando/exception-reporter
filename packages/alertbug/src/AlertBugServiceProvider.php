<?php

namespace AlertBug\AlertBug;

use Illuminate\Support\ServiceProvider;

class AlertBugServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register()
    {
        // Override Laravel's default exception handler
        $this->app->singleton(
            \Illuminate\Contracts\Debug\ExceptionHandler::class,
            \AlertBug\AlertBug\AlertBugHandler::class
        );

        // Merge default configuration
        $this->mergeConfigFrom(
            __DIR__ . '/config/alertbug.php',
            'alertbug'
        );
    }

    /**
     * Boot services.
     */
    public function boot()
    {
        // Publish the configuration file
        $this->publishes([
            __DIR__ . '/config/alertbug.php' => config_path('alertbug.php'),
        ], 'config');
    }
}
