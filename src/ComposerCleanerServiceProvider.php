<?php

namespace Askaoru\ComposerCleaner;

use Illuminate\Support\ServiceProvider;

class ComposerCleanerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/config/cleaner.php' => config_path('/cleaner.php'),
            ], 'config');
        }
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->commands(['Askaoru\ComposerCleaner\ComposerCleanerCommand']);
    }
}