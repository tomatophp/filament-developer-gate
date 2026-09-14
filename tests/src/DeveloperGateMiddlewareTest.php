<?php

use TomatoPHP\FilamentDeveloperGate\Pages\DeveloperGate;
use TomatoPHP\FilamentDeveloperGate\Tests\Models\User;
use TomatoPHP\FilamentDeveloperGate\Tests\Pages\SecretPage;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\get;
use function Pest\Laravel\withSession;
use function Pest\Livewire\livewire;

beforeEach(function () {
    actingAs(User::factory()->create());
});

it('redirects protected pages to the developer gate', function () {
    get(SecretPage::getUrl())->assertRedirect(DeveloperGate::getUrl());
});

it('lets developers through once unlocked', function () {
    withSession(['developer_password' => config('filament-developer-gate.password')])
        ->get(SecretPage::getUrl())
        ->assertOk();
});

it('logs the developer out with the logout action', function () {
    session()->put('developer_password', config('filament-developer-gate.password'));

    livewire(SecretPage::class)
        ->assertActionExists('developer_gate_logout')
        ->callAction('developer_gate_logout')
        ->assertRedirect(DeveloperGate::getUrl());

    expect(session()->has('developer_password'))->toBeFalse();
});
