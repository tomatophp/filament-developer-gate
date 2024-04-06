<?php

namespace TomatoPHP\FilamentDeveloperGate\Http\Controllers;

use App\Http\Controllers\Controller;
use Filament\Notifications\Notification;
use Illuminate\Http\Request;

class DeveloperGateController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'password' => 'required|min:6|string',
            'old' => "required|string|url"
        ]);

        if(!session()->has('old_developer_url')){
            session()->put('old_developer_url', $request->get('old'));
        }

        $password = $request->get('password');

        if($password == config('filament-developer-gate.password')){
            Notification::make()
                ->title(trans('filament-developer-gate::messages.notifications.success.title'))
                ->body(trans('filament-developer-gate::messages.notifications.success.body'))
                ->success()
                ->send();

            session()->put('developer_password', $password);

            $redirect = session()->get('old_developer_url');
            session()->forget('old_developer_url');
            return redirect()->to($redirect);
        }
        else {
            Notification::make()
                ->title(trans('filament-developer-gate::messages.notifications.danger.title'))
                ->body(trans('filament-developer-gate::messages.notifications.danger.body'))
                ->danger()
                ->send();

            return redirect()->back();
        }
    }
}
