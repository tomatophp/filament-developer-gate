<?php

namespace TomatoPHP\FilamentDeveloperGate\Http\Middleware;

use Closure;
use Illuminate\Auth\Middleware\Authenticate as Middleware;
use TomatoPHP\FilamentDeveloperGate\Pages\DeveloperGate;

class DeveloperGatePageMiddleware extends Middleware
{
    public function handle($request, Closure $next, ...$guards)
    {
        if (! session()->has('developer_old_page')) {
            session()->put('developer_old_page', url()->previous());
        }

        if ($this->routeIsNotDeveloperGate() || ! auth()->check()) {
            return $next($request);
        }

        $sessionPassword = session()->get('developer_password');

        if ($sessionPassword !== config('filament-developer-gate.password')) {
            return $next($request);
        }

        return redirect()->to(config('filament.developer-gate.redirect'));
    }

    private function routeIsNotDeveloperGate(bool $check = true)
    {

        $gateRoute = DeveloperGate::getUrl();

        return $check ? (url()->current() !== $gateRoute) : redirect()->to($gateRoute);
    }
}
