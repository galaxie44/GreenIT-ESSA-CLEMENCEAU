<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AdminAuthController extends Controller
{
    public function showLogin(): View
    {
        return view('admin.login');
    }

    public function login(Request $request): RedirectResponse
    {
        $login = env('ADMIN_LOGIN', 'root');
        $password = env('ADMIN_PASSWORD', 'root');

        $request->validate([
            'login' => 'required|string',
            'password' => 'required|string',
        ]);

        if ($request->input('login') === $login && $request->input('password') === $password) {
            session(['admin' => true]);
            return redirect()->route('admin.articles.index');
        }

        return back()->withErrors(['credentials' => 'Login incorrect']);
    }

    public function logout(): RedirectResponse
    {
        session()->forget('admin');

        return redirect()->route('home');
    }
}

