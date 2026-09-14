<?php

namespace TomatoPHP\FilamentDeveloperGate\Tests\Pages;

use Filament\Pages\Page;
use TomatoPHP\FilamentDeveloperGate\Traits\DeveloperGateLogoutAction;
use TomatoPHP\FilamentDeveloperGate\Traits\InteractWithDeveloperGate;

class SecretPage extends Page
{
    use DeveloperGateLogoutAction;
    use InteractWithDeveloperGate;

    protected static ?string $slug = 'secret-page';
}
