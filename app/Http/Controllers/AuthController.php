<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login()
    {
        $data =  [
            'title' => env('APP_NAME'),
            'page' => 'Login'
        ];
        return view('app.login', $data);
    }
    public function authenticate(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('dashboard')
                ->withSuccess('Signed in');
        }
        return back()->with('loginError', 'Data email tidak dapat ditemukan');
    }
    public function register()
    {
        $data =  [
            'title' => env('APP_NAME'),
            'page' => 'Register'
        ];
        return view('app.register', $data);
    }
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'email' => ['required', 'email:dns', 'unique:users'],
            'password' => ['required'],
        ]);
        $validatedData['password'] = Hash::make($validatedData['password']);
        if (User::create($validatedData)) {
            $request->session()->flash('success', 'Berhasil Mendaftar Akun, Silahkan Login');
            return redirect('/app/login');
        }
        return back()->with('registerError', 'Registrasi gagal');
    }
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/app/login');
    }
}
