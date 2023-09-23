<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login()
    {
        return view('login');
    }

    public function proclogin()
    {
        $validate = request()->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string']
        ]);

        if (auth()->attempt($validate)) {
            return redirect('dashboard');
        }

        return redirect()->back()->with([
            'error' => true,
            'message' => 'Email atau Password tidak sesuai'
        ]);
    }

    public function logout()
    {
        auth()->logout();
        return redirect()->route('login');
    }
}
