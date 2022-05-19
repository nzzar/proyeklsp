<?php

namespace App\Http\Controllers;

use App\Models\Asesi;
use App\Models\Prodi;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;

class AuthController extends Controller
{

    public function signIn(Request $request)
    {
        if ($request->method() == 'POST') {

            $request->validate([
                'email' => 'required|email:rfc,dns',
                'password' => 'required'
            ]);


            $authData = ['email' => $request->email, 'password' => $request->password];



            if (Auth::attempt($authData)) {
                $request->session()->regenerate();
                Artisan::call('view:clear');
                return redirect()->intended('/dashboard');
            }

            return redirect('/login')->withErrors(['auth' => 'Wrong email or password']);
        }

        return view('login');
    }


    public function signOut(Request $request)
    {
        $request->session()->invalidate();
        return redirect('/login');
    }

    public function register(Request $request)
    {

        if ($request->method() == 'POST') {
            $request->validate(
                [
                    'name' => 'required|min:3',
                    'nim' => 'required|unique:asesis,nim',
                    'prodi' => 'required|exists:prodis,id',
                    'email' => 'required|email|unique:users,email',
                    'password' => 'required|min:6',
                    'cpassword' => 'required|same:password',
                ],
                [],
                [
                    'name' => 'Name',
                    'nim' => 'NIM',
                    'prodi'=>'Prodi',
                    'cpassword' => 'Retype password'
                 ],
            );

            DB::beginTransaction();

            try {

                $userId = User::insertGetId([
                    'email' => $request->email,
                    'password' => Hash::make($request->password),
                    'active' => true,
                    'role' => 'asesi',
                ]);

                Asesi::insert([
                    'user_id' => $userId,
                    'prodi_id' => $request->prodi,
                    'name' => $request->name,
                    'nim' => $request->nim,
                ]);
                
                DB::commit();
                Session::flash('success', 'Registrasi berhasil!');
                return redirect('/login');
            } catch (Exception $error) {
                DB::rollBack();

                dd($error);
            }
        }


        $prodis = Prodi::all();
        return view('register', compact('prodis'));
    }
}
