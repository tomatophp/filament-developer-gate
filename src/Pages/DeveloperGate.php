<?php

namespace TomatoPHP\FilamentDeveloperGate\Pages;

use Filament\Actions\Action;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Panel;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Concerns\InteractsWithSchemas;
use Filament\Schemas\Contracts\HasSchemas;
use Filament\Schemas\Schema;
use TomatoPHP\FilamentDeveloperGate\Http\Middleware\DeveloperGatePageMiddleware;

class DeveloperGate extends Page implements HasSchemas
{
    use InteractsWithSchemas;

    public static ?string $title = 'Developer Gate';

    public static ?string $icon = 'heroicon-o-lock-closed';

    public string $view = 'filament-developer-gate::login';

    public static string $route = 'developer-gate';

    public array $data = [];

    public function mount()
    {
        $this->data = [
            'password' => '',
        ];
    }

    public static function getRouteMiddleware(Panel $panel): string|array
    {
        return [
            'auth',
            'verified',
            DeveloperGatePageMiddleware::class,
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

    public function getLoginForm(Schema $schema): Schema
    {
        return $schema->schema([
            Section::make(trans('filament-developer-gate::messages.name'))
                ->icon('heroicon-o-lock-closed')
                ->iconColor('danger')
                ->description(trans('filament-developer-gate::messages.description'))
                ->schema([
                    TextInput::make('password')
                        ->label(trans('filament-developer-gate::messages.password-input'))
                        ->password()
                        ->revealable(filament()->arePasswordsRevealable())
                        ->required(fn ($record) => ! $record)
                        ->rule(\Illuminate\Validation\Rules\Password::default()),
                ])
                ->footerActions([
                    Action::make('login')
                        ->label(trans('filament-developer-gate::messages.login'))
                        ->action(fn () => $this->submit()),
                ]),
        ])->statePath('data');
    }

    public function submit()
    {
        $this->getLoginForm->validate();

        $password = $this->data['password'];

        if ($password == config('filament-developer-gate.password')) {
            session()->put('developer_password', $password);

            return redirect()->to(session()->get('developer_old_page'));
        }

        Notification::make()
            ->title(trans('filament-developer-gate::messages.notifications.danger.title'))
            ->body(trans('filament-developer-gate::messages.notifications.danger.body'))
            ->danger()
            ->send();

        return redirect()->back();
    }
}
