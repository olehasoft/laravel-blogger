<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;

Route::middleware('guest')->group(function () {
    Route::get('login', fn () => view('auth.login'))->name('login');

    Route::post('login', function (Request $request) {
        Auth::login(User::firstOrFail(), true);
        $request->session()->regenerate();

        return redirect()->intended();
    });
});

Route::middleware('auth')->group(function () {
    Route::post('logout', function (Request $request) {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    })->name('logout');
});
