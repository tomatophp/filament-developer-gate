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
            return $this->rediectNotDeveloper();
        }

        return $next($request);
    }

    private function routeIsNotDeveloperGate()
    {
        $tenant = Filament::getTenant();

        $gateRoute = $tenant ? route('developer-gate.login.tenant', $tenant) : route('developer-gate.login');

        return url()->current() !== $gateRoute;
    }

    private function rediectNotDeveloper()
    {
        $tenant = Filament::getTenant();

        $gateRoute = $tenant ? route('developer-gate.login.tenant', $tenant) : route('developer-gate.login');

        return redirect()->to($gateRoute);
    }
}
