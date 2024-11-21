<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

    // View Masuk (Login)
    public function signin()
    {
        return view('homepage.login', [
            'group' => 'login',
            'title' => 'Masuk'
        ]);
    }

    // Login 
    public function authenticate(Request $request)
    {
        // Validasi
        $credentials = $request->validate([
            'user' => 'required|min:6|max:255|regex:/^[A-Za-z0-9_.@-]+$/',
            'password' => 'required|min:6|max:255'
        ]);

        // Cek remember me
        $remember = $request->has('remember'); //hasil=true/false

        // Cek apakah username/email yang digunakan
        $fieldType = filter_var($credentials['user'], FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        // Authentikasi
        if (Auth::attempt([$fieldType => $credentials['user'], 'password' => $credentials['password']], $remember)) {
            $request->session()->regenerate(); //untuk mencegah serangan session fixation
            return redirect()->intended('/dashboard');
        }

        return back()->with('failed', 'Username, email, atau password salah')->withInput();
    }

    // Logout
    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }

    // View Daftar
    public function signup()
    {
        return view('homepage.signup', [
            'group' => 'login',
            'title' => 'Buat akun'
        ]);
    }

    //Buat akun (daftar)
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama' => 'required|max:255',
            'email' => 'required|email:dns|unique:users,email',
            'username' => 'required|min:6|max:255|unique:users,username|regex:/^[A-Za-z0-9_.]+$/',
            'password' => 'required|min:6|max:255|same:password2',
            'password2' => 'required|min:6|max:255|same:password',
            'remember' => 'required'
        ]);

        User::create($validatedData);
        return redirect('/masuk')->with('success', 'Akun berhasil terdaftar, silahkan login');
    }

    // Edit data user
    public function editUSer()
    {
        return view('dashboard.setting-userinfo', [
            'group' => 'settings',
            'title' => 'Edit Profil'
        ]);
    }
}
