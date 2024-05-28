<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\LoginRequest;

class LoginController extends Controller
{
    public function login() {
        return view('login');
    }

    public function authenticate(LoginRequest $request) {
        $data = $request->all();

        $credentials = [
            'email' => $data['email'],
            'password' => $data['password'],
        ];
 
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect('/');
        }

        Session::flash('error', 'Usuário ou senha incorretos.');
        return redirect()->back()->withInput();
    }

    public function logout() {
        Auth::logout();
        return redirect()->route('login');
    }
}
