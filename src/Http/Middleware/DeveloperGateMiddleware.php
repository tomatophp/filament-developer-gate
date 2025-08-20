<?php

namespace TomatoPHP\FilamentDeveloperGate\Http\Middleware;

use Closure;
use Illuminate\Auth\Middleware\Authenticate as Middleware;
use TomatoPHP\FilamentDeveloperGate\Pages\DeveloperGate;

class DeveloperGateMiddleware extends Middleware
{
    public function handle($request, Closure $next, ...$guards)
    {
        if (! session()->has('developer_old_page')) {
            session()->put('developer_old_page', url()->previous());
        }

        $sessionPassword = session()->get('developer_password');

        if (($sessionPassword !== config('filament-developer-gate.password')) && $this->routeIsNotDeveloperGate()) {
            return $this->routeIsNotDeveloperGate(false);
        }

        return $next($request);
    }

    private function routeIsNotDeveloperGate(bool $check = true)
    {
        $gateRoute = DeveloperGate::getUrl();

        return $check ? (url()->current() !== $gateRoute) : redirect()->to($gateRoute);
    }
}
