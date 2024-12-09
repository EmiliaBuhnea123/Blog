<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function register()
    {
        return view('pages.auth.register');
    }
    public function storeRegister(RegisterRequest $request)
    {
        $validatedData = $request->validated();
        /** @var User $user */
        $user = User::query()->create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => bcrypt($validatedData['password'])
        ]);
        auth()->login($user);
        return redirect()->route('profile.create');
    }

    ///////////////////////////////////////////////////////////////
    public function login()
    {
        return view('pages.auth.login');
    }

    public function storeLogin(LoginRequest $request)
    {
        $validatedData = $request->validated();

        if (!auth()->attempt($validatedData)) {
            return back()->withErrors([
                'email' => 'The provided credentials do not match our records.',
            ]);
        }

       /** @var \App\Models\User $user */
        $user = auth()->user();

        if ($user && $user->hasRole('admin')) {
            return redirect()->route('admin.profiles');
        }
        
        return redirect()->route('home');
    }

    public function logout()
    {
        auth()->logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        return redirect()->route('home');
    }
}

