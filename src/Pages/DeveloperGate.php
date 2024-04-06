<?php

namespace TomatoPHP\FilamentDeveloperGate\Pages;

use Filament\Pages\Page;
use Filament\Panel;
use TomatoPHP\FilamentDeveloperGate\Http\Middleware\DeveloperGatePageMiddleware;

class DeveloperGate extends Page
{
    public static ?string $title = 'Developer Gate';

    public static ?string $icon = 'heroicon-o-lock-closed';

    public static string $view = 'filament-developer-gate::login';

    public static string $route = 'developer-gate';

    public static function getRouteMiddleware(Panel $panel): string | array
    {
        return [
            'auth',
            'verified',
            DeveloperGatePageMiddleware::class
        ];
    }


    public function getTitle(): string
    {
        return trans('filament-developer-gate::messages.title');
    }

    public static function shouldRegisterNavigation(): bool
    {
        return false;
    }

}
