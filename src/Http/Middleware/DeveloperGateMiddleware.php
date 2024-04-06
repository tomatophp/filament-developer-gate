<?php

namespace TomatoPHP\FilamentDeveloperGate\Http\Middleware;

use Closure;
use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class DeveloperGateMiddleware extends Middleware
{
    public function handle($request, Closure $next, ...$guards)
    {
        if(auth()->user()){
            $sessionPassword = session()->get('developer_password');
            if($sessionPassword == config('filament-developer-gate.password')){
                return $next($request);
            }
            else {
                return redirect()->route('developer-gate.login');
            }
        }
        else {
            return $next($request);
        }
    }
}