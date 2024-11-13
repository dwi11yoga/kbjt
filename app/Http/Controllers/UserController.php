<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
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
}
