<?php

namespace TomatoPHP\FilamentDeveloperGate\Http\Middleware;

use Closure;
use Filament\Facades\Filament;
use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class DeveloperGateMiddleware extends Middleware
{
    public function handle($request, Closure $next, ...$guards)
    {
        $sessionPassword = session()->get('developer_password');

        if (($sessionPassword !== config('filament-developer-gate.password')) && $this->routeIsNotDeveloperGate()) {
            return $this->routeIsNotDeveloperGate(false);
        }

        return $next($request);
    }

    private function routeIsNotDeveloperGate(bool $check=true)
    {
        $tenant = Filament::getTenant();

        $gateRoute = $tenant ? route('developer-gate.login.tenant', $tenant) : route('developer-gate.login');

        return $check ? (url()->current() !== $gateRoute) : redirect()->to($gateRoute);
    }

}
