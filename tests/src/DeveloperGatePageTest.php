<?php

use TomatoPHP\FilamentDeveloperGate\Pages\DeveloperGate;
use TomatoPHP\FilamentDeveloperGate\Tests\Models\User;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\get;
use function Pest\Laravel\withSession;
use function Pest\Livewire\livewire;

beforeEach(function () {
    actingAs(User::factory()->create());
});

it('renders the developer gate page', function () {
    livewire(DeveloperGate::class)
        ->assertSuccessful()
        ->assertFormFieldExists('password', 'getLoginForm');
});

it('serves the developer gate route', function () {
    get(DeveloperGate::getUrl())->assertOk();
});

it('redirects away from the gate when already unlocked', function () {
    withSession(['developer_password' => config('filament-developer-gate.password')])
        ->get(DeveloperGate::getUrl())
        ->assertRedirect(config('filament-developer-gate.redirect'));
});

it('requires a password', function () {
    livewire(DeveloperGate::class)
        ->fillForm(['password' => ''], 'getLoginForm')
        ->call('submit')
        ->assertHasFormErrors(['password' => 'required'], 'getLoginForm');
});

it('unlocks with the configured password', function () {
    session()->put('developer_old_page', '/admin/secret-page');

    livewire(DeveloperGate::class)
        ->fillForm(['password' => config('filament-developer-gate.password')], 'getLoginForm')
        ->call('submit')
        ->assertHasNoFormErrors([], 'getLoginForm')
        ->assertRedirect('/admin/secret-page');

    expect(session('developer_password'))->toBe(config('filament-developer-gate.password'));
});

it('rejects a wrong password', function () {
    livewire(DeveloperGate::class)
        ->fillForm(['password' => 'wrong-password'], 'getLoginForm')
        ->call('submit')
        ->assertNotified();

    expect(session()->has('developer_password'))->toBeFalse();
});
