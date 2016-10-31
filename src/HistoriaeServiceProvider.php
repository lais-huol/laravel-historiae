<?php

namespace Historiae;

use Historiae\Observers\ChangesObserver;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;


class HistoriaeServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'historiae');

        $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'historiae');

        if ($this->app->runningInConsole()) {
            $this->loadMigrationsFrom(__DIR__.'/../database/migrations');

            $this->publishes([
                __DIR__.'/../resources/views' => resource_path('views/vendor/historiae'),
            ], 'historiae-views');

            $this->publishes([
                __DIR__.'/../resources/lang' => resource_path('lang/vendor/historiae'),
            ], 'historiae-lang');

            $this->publishes([
                __DIR__.'/../config/historiae.php' => config_path('historiae.php'),
            ]);
        }

        foreach ($this->getConfig('models') as $model) {
            $model::observe(ChangesObserver::class);
        }

        if ($this->getConfig('access')) {
            Event::listen('kernel.handled', 'Historiae\Listeners\LogAccess');
        }

        if (!$this->app->routesAreCached() && is_array($this->getConfig('middleware'))) {
            require __DIR__.'/../routes.php';
        }
    }

    public function getConfig($name)
    {
        return $this->app['config']["historiae.{$name}"];
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
    }
}
