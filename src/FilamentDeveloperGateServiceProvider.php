<?php

namespace TomatoPHP\FilamentDeveloperGate;

use Illuminate\Support\ServiceProvider;


class FilamentDeveloperGateServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //Register generate command
        $this->commands([
           \TomatoPHP\FilamentDeveloperGate\Console\FilamentDeveloperGateInstall::class,
        ]);

        //Register Config file
        $this->mergeConfigFrom(__DIR__.'/../config/filament-developer-gate.php', 'filament-developer-gate');

        //Publish Config
        $this->publishes([
           __DIR__.'/../config/filament-developer-gate.php' => config_path('filament-developer-gate.php'),
        ], 'filament-developer-gate-config');

        //Register views
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'filament-developer-gate');

        //Publish Views
        $this->publishes([
           __DIR__.'/../resources/views' => resource_path('views/vendor/filament-developer-gate'),
        ], 'filament-developer-gate-views');

        //Register Langs
        $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'filament-developer-gate');

        //Publish Lang
        $this->publishes([
           __DIR__.'/../resources/lang' => base_path('lang/vendor/filament-developer-gate'),
        ], 'filament-developer-gate-lang');

        //Register Routes
        $this->loadRoutesFrom(__DIR__.'/../routes/web.php');

    }

    public function boot(): void
    {
        //you boot methods here
    }
}
