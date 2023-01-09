<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator, Redirect, Response;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function index() {
        
        return view('auth.login');
    }

    public function login(Request $request) {
        
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:8',
        ]);
        if(\Auth::attempt($request->only('email', 'password'))){
            return redirect('home')->withSuccess('Welcome!');
        }
        
        return redirect('login')->withError('No such a user exist');
    }

    public function logout(Request $request) {
        \Session::flush();
        \Auth::logout();
        $route = 'login';
        
        return redirect($route);
    }
public function register(Request $request) {
        // dd($request->all());
        $request->validate([
            'email' => 'required|unique:users|email',
            'password' => 'required|min:8',
        ]);

        User::create([
            "name" => $request->name,
            "email" => $request->email,
            "password" => \Hash::make($request->password),
            "remember_token" => $request->_token
        ]);

        if(\Auth::attempt($request->only('email', 'password'))){
            return redirect('home')->withSuccess('Welcome!');
        }
        
        
    }
    public function register_view() {
        return view('auth.register');    
    }
}


