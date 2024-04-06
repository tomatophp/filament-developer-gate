<?php

namespace TomatoPHP\FilamentDeveloperGate\Traits;

use Filament\Actions\Action;
use Filament\Notifications\Notification;

trait DeveloperGateLogoutAction
{
    protected function getHeaderActions(): array
    {
        return array_merge($this->getActions(), [
            Action::make('developer_gate_logout')
                ->action(function (){
                    session()->forget('developer_password');

                    Notification::make()
                        ->title(trans('filament-developer-gate::messages.notifications.logout.title'))
                        ->body(trans('filament-developer-gate::messages.notifications.logout.body'))
                        ->success()
                        ->send();

                    return redirect()->to('admin/developer-gate');
                })
                ->requiresConfirmation()
                ->color('danger')
                ->label(trans('filament-developer-gate::messages.logout'))
        ]);
    }
}
