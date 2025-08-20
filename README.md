![Screenshot](https://raw.githubusercontent.com/tomatophp/filament-developer-gate/master/arts/fadymondy-tomato-developer-gate.jpg)

# Filament developer gate

[![Dependabot Updates](https://github.com/tomatophp/filament-developer-gate/actions/workflows/dependabot/dependabot-updates/badge.svg)](https://github.com/tomatophp/filament-developer-gate/actions/workflows/dependabot/dependabot-updates)
[![PHP Code Styling](https://github.com/tomatophp/filament-developer-gate/actions/workflows/fix-php-code-styling.yml/badge.svg)](https://github.com/tomatophp/filament-developer-gate/actions/workflows/fix-php-code-styling.yml)
[![Tests](https://github.com/tomatophp/filament-developer-gate/actions/workflows/tests.yml/badge.svg)](https://github.com/tomatophp/filament-developer-gate/actions/workflows/tests.yml)
[![Latest Stable Version](https://poser.pugx.org/tomatophp/filament-developer-gate/version.svg)](https://packagist.org/packages/tomatophp/filament-developer-gate)
[![License](https://poser.pugx.org/tomatophp/filament-developer-gate/license.svg)](https://packagist.org/packages/tomatophp/filament-developer-gate)
[![Downloads](https://poser.pugx.org/tomatophp/filament-developer-gate/d/total.svg)](https://packagist.org/packages/tomatophp/filament-developer-gate)

Secure your selected route by using a middleware with static password for developers only

## Screenshots

![Login](https://raw.githubusercontent.com/tomatophp/filament-developer-gate/master/arts/login.png)
![Logout](https://raw.githubusercontent.com/tomatophp/filament-developer-gate/master/arts/logout-action.png)
![Logout Confirm](https://raw.githubusercontent.com/tomatophp/filament-developer-gate/master/arts/logout-confirm.png)


## Installation

```bash
composer require tomatophp/filament-developer-gate
```

finally reigster the plugin on `/app/Providers/Filament/AdminPanelProvider.php`

```php
$panel->plugin(\TomatoPHP\FilamentDeveloperGate\FilamentDeveloperGatePlugin::make())
```


## Usage

to secure selected resource or page you can use this trait

```php
use TomatoPHP\FilamentDeveloperGate\Traits\InteractWithDeveloperGate;
```

or you can use the middleware direct on your routes like this

```php
Route::middleware([\TomatoPHP\FilamentDeveloperGate\Http\Middleware\DeveloperGateMiddleware::class])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
```

you can add a logout action button to your page or resource by using this trait

```php
use TomatoPHP\FilamentDeveloperGate\Traits\DeveloperGateLogoutAction;
```

or you can use direct action like this

```php
use TomatoPHP\FilamentDeveloperGate\Actions\DeveloperLogoutAction;


DeveloperLogoutAction::make();
```

## Publish Assets

you can publish config file by use this command

```bash
php artisan vendor:publish --tag="filament-developer-gate-config"
```

you can publish views file by use this command

```bash
php artisan vendor:publish --tag="filament-developer-gate-views"
```

you can publish languages file by use this command

```bash
php artisan vendor:publish --tag="filament-developer-gate-lang"
```

you can publish migrations file by use this command

```bash
php artisan vendor:publish --tag="filament-developer-gate-migrations"
```

## Testing

if you like to run `PEST` testing just use this command

```bash
composer test
```

## Code Style

if you like to fix the code style just use this command

```bash
composer format
```

## PHPStan

if you like to check the code by `PHPStan` just use this command

```bash
composer analyse
```


## Other Filament Packages

Checkout our [Awesome TomatoPHP](https://github.com/tomatophp/awesome)

