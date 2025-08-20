<?php

namespace TomatoPHP\FilamentDeveloperGate\Actions;

use Filament\Actions\Action;
use Filament\Notifications\Notification;
use TomatoPHP\FilamentDeveloperGate\Pages\DeveloperGate;

class DeveloperLogoutAction extends Action
{
    public function setUp(): void
    {
        parent::setUp();

        $this
            ->name('developer_gate_logout')
            ->action(function () {
                session()->put('developer_old_page', url()->previous());
                session()->forget('developer_password');

                Notification::make()
                    ->title(trans('filament-developer-gate::messages.notifications.logout.title'))
                    ->body(trans('filament-developer-gate::messages.notifications.logout.body'))
                    ->success()
                    ->send();

                return redirect()->to(DeveloperGate::getUrl());
            })
            ->requiresConfirmation()
            ->icon('heroicon-o-lock-closed')
            ->color('danger')
            ->label(trans('filament-developer-gate::messages.logout'));
    }
}
