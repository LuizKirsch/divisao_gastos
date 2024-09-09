<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function index(){
        return view('auth.login');
    }

    public function login_action(Request $request){
        $validator = $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:4'
        ]);

        if (Auth::attempt($validator)) {
            $request->session()->regenerate();

            $user = Auth::user();

            return redirect()->route('user.index');
        }

        return redirect()->back()->withErrors(['message' => 'Credenciais inválidas.'])->withInput();
    }
}
