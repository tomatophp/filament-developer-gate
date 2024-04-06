<?php

namespace TomatoPHP\FilamentDeveloperGate\Traits;

use Filament\Panel;
use TomatoPHP\FilamentDeveloperGate\Http\Middleware\DeveloperGateMiddleware;

trait InteractWithDeveloperGate
{
    public static function getRouteMiddleware(Panel $panel): string | array
    {
        return [
            'auth',
            'verified',
            DeveloperGateMiddleware::class
        ];
    }
}
