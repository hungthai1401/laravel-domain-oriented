<?php

namespace HT\LaravelDomainOriented;

use HT\LaravelDomainOriented\Commands\MakeDomainCommand;
use Illuminate\Support\ServiceProvider as BaseServiceProvider;

class ServiceProvider extends BaseServiceProvider
{
    public function boot(): void
    {
        $configPath = __DIR__ . '/Config/domain.php';
        $this->mergeConfigFrom($configPath, 'domain');
        $this->publishes([
            $configPath => config_path('domain.php'),
        ], 'config');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register(): void
    {
        if (! $this->app->runningInConsole()) {
            return;
        }

        $this->commands([
            MakeDomainCommand::class,
        ]);
    }
}
