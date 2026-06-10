<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;

class AuthController extends Controller
{
    public function loginView()
    {
        if(auth()->check()) {
            return redirect('home');
        }

        return view('auth.login');
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email'  => 'required',
            'password' => 'required',
        ],
        [
            'name.required' => 'Nama wajib diisi.',
            'email.required' => 'Username wajib diisi.',
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput()
                ->with('error', 'Gagal login');
        }

        if (auth()->check()) {
            return redirect('home');
        }

        $credentials = $request->only('email', 'password');
        if (auth()->attempt($credentials)) {
            return redirect('home');
        }

        return redirect('login')->with('error', 'Username atau password salah');
    }

    public function logout(Request $request) {
        auth()->logout();
        return redirect('login');
    }
}
