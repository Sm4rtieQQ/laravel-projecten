<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Http\Requests\UserRequest;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Gate;

class UserController extends Controller
{
    public function authenticate(UserRequest $request): RedirectResponse
    {
        $credentials = $request->validated();

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->intended('dashboard');
        }

        return back()->withErrors([
            'password' => 'Email of wachtwoord onjuist.',
        ])->onlyInput('email');
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('articles.index');
    }

    public function store(RegisterRequest $request)
    {
        User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
            'is_premium' => false,
        ]);

        return view('user.login');
    }

    public function dashboard()
    {
        return view('user.dashboard');
    }

    public function show()
    {
        return view('user.login');
    }

    public function register()
    {
        return view('user.register');
    }

    public function shop()
    {
        return view('user.shop');
    }

    public function update_type(Request $request)
    {
        $type = $request->input('account_type');

        if ($type === 'premium') {
            Auth::user()->update(['is_premium' => true]);
        } elseif ($type === 'free') {
            Auth::user()->update(['is_premium' => false]);
        }

        return view('user.dashboard');
    }
}
