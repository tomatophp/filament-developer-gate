<?php

use Illuminate\Support\Facades\Route;

Route::middleware('web')->group(function (){
    Route::post('/admin/{tenent}/developer-gate', [TomatoPHP\FilamentDeveloperGate\Http\Controllers\DeveloperGateController::class, 'login'])->name('developer-gate.login.tenent');
    Route::post('/admin/developer-gate', [TomatoPHP\FilamentDeveloperGate\Http\Controllers\DeveloperGateController::class, 'login'])->name('developer-gate.login');
});
