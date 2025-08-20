<?php

use Filament\Facades\Filament;
use TomatoPHP\FilamentDeveloperGate\FilamentDeveloperGatePlugin;

it('registers plugin', function () {
    $panel = Filament::getCurrentOrDefaultPanel();

    $panel->plugins([
        FilamentDeveloperGatePlugin::make(),
    ]);

    expect($panel->getPlugin('filament-developer-gate'))
        ->not()
        ->toThrow(Exception::class);
});
