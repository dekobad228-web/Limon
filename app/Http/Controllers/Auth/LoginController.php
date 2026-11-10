<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;

class LoginController extends Controller
{
    public function index()
    {

        return view('auth.login');
    }

    public function store(LoginRequest $request)
    {
        $credentials = $request->validated();
        if (Auth::attempt($credentials, true)) {
            $request->session()->regenerate();

            return redirect()->intended(route(name: 'user.start', parameters: $request->user()));
        }

        return back()->withErrors('Не удалось войти в профиль');
    }
}
