<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;

class AuthController extends Controller
{

    public function signIn(Request $request) {
        if($request->method() == 'POST') {

            $request->validate([
                'email' => 'required|email:rfc,dns',
                'password' => 'required'
            ]);


            $authData = ['email' => $request->email, 'password' => $request->password];



            if(Auth::attempt($authData)) {
                $request->session()->regenerate();
                return redirect()->intended('/dashboard');
            }

            return redirect('/login')->withErrors(['auth' => 'Wrong email or password']);

        }

        return view('login');
    }
    

    public function signOut(Request $request) {
        $request->session()->invalidate();
        return redirect('/login');
    }
}
