<?php

use Illuminate\Support\Facades\Route;

Route::middleware('web')->group(function (){
    Route::get('/admin/developer-gate', [TomatoPHP\FilamentDeveloperGate\Http\Controllers\DeveloperGateController::class, 'login'])->name('developer-gate.login');
});
