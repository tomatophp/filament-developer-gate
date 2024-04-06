<?php

namespace TomatoPHP\FilamentDeveloperGate\Http\Controllers;

use App\Http\Controllers\Controller;

class DeveloperGateController extends Controller
{
    public function login()
    {
        return view('filament-developer-gate::login');
    }

    public function authenticate(Request $request)
    {
        $password = $request->password;
        if($password == config('filament-developer-gate.password')){
            session()->put('developer_password', $password);
            return redirect()->route('filament.dashboard');
        }
        else {
            return redirect()->back()->with('error', 'Invalid password');
        }
    }

    public function logout()
    {
        session()->forget('developer_password');
        return redirect()->route('developer-gate.login');
    }
}
