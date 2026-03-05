<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\MemberProfile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // FORM LOGIN
    public function showLogin()
    {
        return view('auth.login');
    }

    // PROSES LOGIN
    public function login(Request $request)
    {
        $request->validate([
            'email'=>'required|email',
            'password'=>'required|string'
        ]);

        if(Auth::attempt($request->only('email','password')))
        {
            return redirect()->route('dashboard');
        }

        return back()->with('error','Login gagal, cek email dan password!');
    }

    // FORM REGISTER
    public function showRegister()
    {
        return view('auth.register');
    }

    // PROSES REGISTER
    public function register(Request $request)
    {
        $request->validate([
            'name'=>'required|string|max:255',
            'email'=>'required|email|unique:users,email',
            'password'=>'required|min:6|confirmed',
        ]);

        $user = User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>Hash::make($request->password),
            'role'=>'member',
        ]);

        MemberProfile::create([
            'name'=>$user->name,
            'user_id'=>$user->id
        ]);

        return redirect()->route('login')->with('success','Akun berhasil dibuat, silakan login.');
    }

    // LOGOUT
    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}