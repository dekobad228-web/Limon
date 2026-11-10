<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Support\Facades\{Hash, Log};
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function index()
    {

        return view('auth.register');
    }

    public function store(RegisterRequest $request)
    {
        [
            'name' => $name,
            'email' => $email,
            'password' => $password
        ] = $request->validated();

        try {
            User::firstOrCreate([
                'name' => $name,
                'email' => $email,
                'password' => Hash::make($password)
            ]);
        } catch (\Throwable $th) {
            Log::error($th);
            return back(302)->withErrors('Такой пользователь уже существует');
        }
        return redirect(route('login.index'))
            ->with('email', $email)
            ->with('message', 'Пользователь успешно зарегистрирован');
    }
}
