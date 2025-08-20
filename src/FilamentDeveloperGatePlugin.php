<?php

namespace TomatoPHP\FilamentDeveloperGate;

use Filament\Contracts\Plugin;
use Filament\Panel;
use TomatoPHP\FilamentDeveloperGate\Pages\DeveloperGate;

class FilamentDeveloperGatePlugin implements Plugin
{
    public function getId(): string
    {
        return 'filament-developer-gate';
    }

    public function register(Panel $panel): void
    {
        $panel
            ->pages([
                DeveloperGate::class,
            ]);
    }

    public function boot(Panel $panel): void
    {
        //
    }

    public static function make(): static
    {
        return new static;
    }
}
