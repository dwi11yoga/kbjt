<?php

namespace App\Http\Controllers;

use App\Models\Definisi;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules\File;

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
            'username' => 'required|min:6|max:255|lowercase|unique:users,username|regex:/^[A-Za-z0-9_.]+$/',
            'password' => 'required|min:6|max:255|same:password2',
            'password2' => 'required|min:6|max:255|same:password',
            'remember' => 'required'
        ]);

        User::create($validatedData);
        return redirect('/masuk')->with('success', 'Akun berhasil terdaftar, silahkan login');
    }

    // Profil user
    public function profile($username)
    {
        // Data user
        $user = User::select(['id', 'nama', 'username', 'email', 'tampilkan_email', 'role', 'tgl_lahir', 'kota', 'jenis_kelamin', 'profile_pic', 'bio', 'telp', 'tautan', 'media_sosial', 'donasi', 'poin', 'achivement', 'terakhir_aktif', 'created_at'])
            ->where('username', $username)
            ->first();
        $user['level'] = $this->levelCalculator($user['poin']);
        // url user
        $user['url'] = $this->getUrl() . '/u/' . $user['username'];

        // Hitung jumlah data medsos
        $user['jmlMedsos'] = 0;
        if (isset($user['media_sosial'])) {
            $user['jmlMedsos'] = count(array_filter($user['media_sosial'], function ($value) {
                return $value !== null && $value != "";
            }));
        }


        // dapatkan definisi buatan user
        $definisi = User::find($user['id'])
            ->definisi()
            ->with('kosakata:id,kosakata,slug')
            ->orderBy('updated_at', 'desc')
            ->get();
        foreach ($definisi as $d) {
            $d['slug'] = $d->kosakata['slug'];
            $d['kosakata'] = $d->kosakata['kosakata'];
        }

        // Dapatkan kosakata dari user
        $kosakata = User::find($user['id'])->kosakata()->orderBy('updated_at', 'desc')->get();

        // return
        return view('homepage.profile', [
            'title' => $user['nama'] . ' ' . '(' . $username . '',
            'user' => $user,
            'definisi' => $definisi,
            'kosakata' => $kosakata
        ]);
    }

    // Edit data user
    public function editUSer()
    {
        return view('dashboard.setting-userinfo', [
            'group' => 'settings',
            'title' => 'Edit Profil'
        ]);
    }
    // Simpan perubahan data user
    public function update(Request $request)
    {
        $rules = [
            'nama' => 'required|max:255',
            'tgl_lahir' => 'required|date',
            'kota' => '',
            'jenis_kelamin' => 'required',
            'telp' => 'nullable|numeric|digits_between:10,15',
            'fb' => '',
            'ig' => '',
            'x' => '',
            'tiktok' => '',
            'wa' => 'nullable|numeric|digits_between:10,15|',
            'telegram' => '',
            'linkedin' => '',
            'github' => '',
            'bio' => '',
            'tautan' => 'nullable|url',
            'profile_pic' => [File::types(['jpg', 'jpeg', 'png', 'webp', 'tiff', 'bmp'])->max(1024)],
        ];

        // Validasi metode donasi
        if ($request->metode_donasi != null) {
            $rules['rekening'] = 'required';
        }

        // If else username tidak diubah
        if ($request->username != Auth::user()->username) {
            $rules['username'] = 'required|min:6|max:255|unique:users,username|regex:/^[A-Za-z0-9_.]+$/';
        } else {
            $rules['username'] = '';
        }


        // validasi data
        $validatedData = $request->validate($rules);

        $arraySimpan = [
            'username' => $validatedData['username'],
            'nama' => $validatedData['nama'],
            'tgl_lahir' => $validatedData['tgl_lahir'],
            'kota' => $validatedData['kota'],
            'jenis_kelamin' => $validatedData['jenis_kelamin'],
            'bio' => $validatedData['bio'],
            'tautan' => $validatedData['tautan'],
            'telp' => $validatedData['telp'],
            'media_sosial' => [
                'fb' => $validatedData['fb'] ?? null,
                'x' => $validatedData['x'] ?? null,
                'ig' => $validatedData['ig'] ?? null,
                'tiktok' => $validatedData['tiktok'] ?? null,
                'wa' => $validatedData['wa'] ?? null,
                'telegram' => $validatedData['telegram'] ?? null,
                'linkedin' => $validatedData['linkedin'] ?? null,
                'github' => $validatedData['github'] ?? null
            ],
            'donasi' => ['metode' => $request->metode_donasi ?? null, 'rekening' => $validatedData['rekening'] ?? null]
        ];

        // tambahkan metode donasi (jika ada)
        // if ($request->metode_donasi != null) {
        //     $arraySimpan['donasi'] = ['metode' => $request->metode_donasi, 'rekening' => $validatedData['rekening']];
        // }

        // simpan gambar ke penyimpanan
        if ($request->pp_remove == 'on') {
            $arraySimpan['profile_pic'] = null;
        } elseif ($request->profile_pic != null) {
            $validatedData['profile_pic'] = $request->file('profile_pic')->store('profile-pics');
            $arraySimpan['profile_pic'] = $validatedData['profile_pic'];
        }

        DB::table('users')->where('id', Auth::user()->id)->update($arraySimpan);

        // Hapus foto lama
        if ($request->pp_remove == 'on') {
            Storage::delete($request->oldPP);
        } elseif ($request->profile_pic != null && $request->oldPP) {
            Storage::delete($request->oldPP);
        }

        return back()->with('success', 'Profil berhasil diperbarui.');
    }
}
