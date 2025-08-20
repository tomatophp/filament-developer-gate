<?php

namespace TomatoPHP\FilamentDeveloperGate\Traits;

use TomatoPHP\FilamentDeveloperGate\Actions\DeveloperLogoutAction;

trait DeveloperGateLogoutAction
{
    protected function getHeaderActions(): array
    {
        return array_merge($this->getActions(), [
            DeveloperLogoutAction::make(),
        ]);
    }
}
