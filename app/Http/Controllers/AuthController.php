<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserSistem;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLogin()
    {
        if (session()->has('user')) {
            return redirect()->route('dashboard');
        }
        return view('login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        $user = UserSistem::where('username', $request->username)->first();

        if ($user && Hash::check($request->password, $user->password)) {
            session([
                'user'    => $user->username,
                'level'   => $user->level,
                'id_user' => $user->id_user,
            ]);
            return redirect()->route('dashboard');
        }

        return back()
            ->withErrors(['login' => 'Login Gagal! Username atau Password Salah.'])
            ->withInput();
    }

    public function logout()
    {
        session()->flush();
        return redirect()->route('login');
    }
}