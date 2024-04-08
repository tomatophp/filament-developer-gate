<?php

namespace TomatoPHP\FilamentDeveloperGate\Http\Middleware;

use Closure;
use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class DeveloperGatePageMiddleware extends Middleware
{
    public function handle($request, Closure $next, ...$guards)
    {
        $tenant = \Filament\Facades\Filament::getTenant();
        if(auth()->user()){
            if($tenant){
                if(url()->current() === route('developer-gate.login', $tenant)){
                    $sessionPassword = session()->get('developer_password');
                    if($sessionPassword == config('filament-developer-gate.password')){
                        return redirect()->to('/admin');
                    }
                    else {
                        return $next($request);
                    }
                }
                else {
                    return $next($request);
                }
            }
            else {
                if(url()->current() === route('developer-gate.login')){
                    $sessionPassword = session()->get('developer_password');
                    if($sessionPassword == config('filament-developer-gate.password')){
                        return redirect()->to('/admin');
                    }
                    else {
                        return $next($request);
                    }
                }
                else {
                    return $next($request);
                }
            }

        }
        else {
            return $next($request);
        }
    }
}
