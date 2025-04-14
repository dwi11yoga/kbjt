<?php

namespace App\Http\Controllers;

use App\Models\Achievement;
use App\Models\Blog;
use App\Models\Definisi;
use App\Models\Kosakata;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules\File;
use Illuminate\Validation\ValidationException;

use function Laravel\Prompts\error;

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

            // cek achievement
            $userId = Auth::user()->id;
            // cek achievement lama bergabung
            $value = round(Auth::user()->created_at->diffInDays(now())) ?? 0;
            $this->achievement($userId, 'keanggotaan', $value);

            // cek achievement view kosakata
            $value = Kosakata::where('user_id', '=', $userId)->orderBy('view', 'desc')->value('view') ?? 0;
            $this->achievement($userId, 'viewKosakata', $value);

            // cek achievement total view kosakata
            $value = Kosakata::where('user_id', '=', $userId)->sum('view') ?? 0;
            $this->achievement($userId, 'totalViewKosakata', $value);

            // cek achievement view blog
            $value = Blog::where('user_id', '=', $userId)->orderBy('view', 'desc')->value('view') ?? 0;
            $this->achievement($userId, 'viewKosakata', $value);

            // cek achievement total view blog
            $value = Blog::where('user_id', '=', $userId)->sum('view') ?? 0;
            $this->achievement($userId, 'totalViewBlog', $value);

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
        $user = User::where('username', $username)->first();
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
            ->paginate(10, ['*'], 'definisi-page')
            ->appends(request()->query());
        foreach ($definisi as $d) {
            $d['slug'] = $d->kosakata['slug'];
            $d['kosakata'] = $d->kosakata['kosakata'];
        }


        // Dapatkan kosakata dari user
        $kosakata = User::find($user['id'])
            ->kosakata()
            ->orderBy('updated_at', 'desc')
            ->paginate(10, ['*'], 'kosakata-page')
            ->appends(request()->query());

        $kirim = [
            'title' => $user['nama'] . ' ' . '(' . $username . '',
            'user' => $user,
            'definisi' => $definisi,
            'kosakata' => $kosakata,
            'group' => 'Profil user',
        ];

        // dapatkan daftar artikel by user
        if ($user['role'] == 'pengurus') {
            $posts = Blog::select('id', 'judul', 'slug', 'user_id', 'status', 'updated_at', 'thumbnail')
                ->with('user:id,username,nama')
                ->where('user_id', '=', $user['id'])
                ->orderBy('updated_at', 'desc')
                ->paginate(10, ['*'], 'artikel-page')
                ->appends(request()->query());
            $kirim['posts'] = $posts;
        }

        // dapatkan data banner
        $banner = $this->getBanner([1, 2]);
        $kirim['banner'] = $banner;

        // return
        return view('homepage.profile', $kirim);
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
            'profile_pic' => [File::types(['jpg', 'jpeg', 'png', 'webp'])->max(1024)],
            'bio' => ''
        ];

        // validasi data
        try {
            $validatedData = $request->validate($rules);
        } catch (ValidationException $e) {
            return back()
                ->with('failed', 'Gagal menyimpan perubahan')
                ->withErrors($e->errors())
                ->withInput();
        }

        $arraySimpan = [
            'nama' => $validatedData['nama'],
            'tgl_lahir' => $validatedData['tgl_lahir'],
            'kota' => $validatedData['kota'],
            'jenis_kelamin' => $validatedData['jenis_kelamin'],
            'bio' => $validatedData['bio'],
        ];

        // simpan gambar ke penyimpanan
        if ($request->pp_remove == 'on') {
            $arraySimpan['profile_pic'] = null;
        } elseif ($request->profile_pic != null) {
            if (isset(Auth::user()->profile_pic)) {
                // hapus foto jika ada
                Storage::delete(Auth::user()->profile_pic);
            }
            $validatedData['profile_pic'] = $request->file('profile_pic')->store('profile-pics');
            $arraySimpan['profile_pic'] = $validatedData['profile_pic'];
        }

        // Hapus foto lama
        if ($request->pp_remove == 'on' && isset(Auth::user()->profile_pic)) {
            Storage::delete(Auth::user()->profile_pic);
        }
        // if ($request->pp_remove == 'on') {
        //     Storage::delete($request->oldPP);
        // } elseif ($request->profile_pic != null && $request->oldPP) {
        //     Storage::delete($request->oldPP);
        // }

        // simpan perubahan di db
        User::find(Auth::user()->id)->update($arraySimpan);

        // kembali ke tampilan
        return back()->with('success', 'Profil berhasil diperbarui');
    }

    // view edit tautan
    public function tautan()
    {
        return view('dashboard.setting-tautan', [
            'title' => 'Ubah tautan',
            'group' => 'settings'
        ]);
    }

    // simpan tautan
    public function simpanTautan(Request $request)
    {
        // validasi
        $validatedData = $request->validate([
            'telp' => 'nullable|numeric|digits_between:10,15',
            'fb' => '',
            'ig' => '',
            'x' => '',
            'tiktok' => '',
            'wa' => 'nullable|numeric|digits_between:10,15|',
            'telegram' => '',
            'linkedin' => '',
            'github' => '',
            'tautan' => 'nullable|url',
        ]);

        // simpan data
        $data = [
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
        ];
        User::find(Auth::user()->id)->update($data);

        // kembali ke view
        return back()->with('success', 'Informasi user berhasil diperbarui');
    }

    // view data sensitif
    public function dataSensitif()
    {
        return view('dashboard.setting-datasensitif', [
            'title' => 'Sembunyikan data sensitif',
            'group' => 'settings'
        ]);
    }
    // simpan data sensitif
    public function simpanDataSensitif(Request $request)
    {
        // Simpan
        $data = [];
        if (isset($request['email'])) {
            $data['email'] = true;
        } else {
            $data['email'] = false;
        }

        if (isset($request['telp'])) {
            $data['telp'] = true;
        } else {
            $data['telp'] = false;
        }

        User::find(Auth::user()->id)->update(['sembunyikan_data' => $data]);
        return back()->with('success', 'Preferensi berhasil disimpan');
    }

    // view terima donasi
    public function userDonasi()
    {
        return view('dashboard.setting-terimadonasi', [
            'title' => 'Terima donasi',
            'group' => 'settings'
        ]);
    }
    // fungsi simpan update donasi
    public function simpanUserDonasi(Request $request)
    {
        // validasi
        // lakukan validasi jika metode donasi dipilih
        if (isset($request->donasi)) {
            // jika donasi di-enable
            $rules = [
                'metode_donasi' => 'required',
                'rekening' => 'required',
            ];
            $validatedData = $request->validate($rules);
            $data = [
                'metode' => $validatedData['metode_donasi'],
                'rekening' => $validatedData['rekening']
            ];
        } else {
            // jika donasi di-disable
            $data = null;
        }

        // simpan data
        User::find(Auth::user()->id)->update(['donasi' => $data]);

        // kembalikan ke view
        return redirect()->back()->with('success', 'Data berhasil diperbarui');
    }

    // view ubah username
    public function ubahUsername()
    {
        return view('dashboard.setting-ubahusername', [
            'title' => 'Ubah username',
            'group' => 'settings'
        ]);
    }
    // fungsi simpan username
    public function simpanUbahUsername(Request $request)
    {
        // validasi
        $validatedData = $request->validate([
            'username' => 'required|min:6|max:255|lowercase|unique:users,username,' . Auth::user()->id . ',id|regex:/^[A-Za-z0-9_.]+$/',
            'password' => 'required|min:6|max:255',
        ]);

        // jika username yang dimasukkan sama (tidak berubah), kembalikan ke view
        if ($validatedData['username'] == Auth::user()->username) {
            return back()->with('success', 'Tidak ada perubahan yang dilakukan');
        }

        // SIMPAN PERUBAHAN USERNAME
        // authentikasi: cek apakah password yang dimasukkan sudah sama dengan password user
        if (!Hash::check($request->password, Auth::user()->password)) { //jika tidak sama...
            return back()->with('failed', 'Gagal menyimpan perubahan')
                ->withInput()
                ->withErrors(['password' => 'The password are incorrect.']);
        }

        // jika password yang diinput sama, simpan di db
        User::find(Auth::user()->id)->update(['username' => $validatedData['username']]);

        // kirim notifikasi via email - belum

        // kembalikan ke view
        return back()->with('success', 'Berhasil menyimpan perubahan');
    }

    // view ubah email
    public function ubahEmail(){
        return view('dashboard.setting-ubahemail', [
            'title'=> 'Ubah alamat email',
            'group'=>'settings'
        ]);
    }

    // fungsi update ubah email
    public function simpanUbahEmail(Request $request){

        // validasi
        $validatedData = $request->validate([
            'email' => 'required|email:dns|unique:users,email,' . Auth::user()->id . ',id',
            'password' => 'required|min:6|max:255',
        ]);

        // jika username yang dimasukkan sama (tidak berubah), kembalikan ke view
        if ($validatedData['email'] == Auth::user()->email) {
            return back()->with('success', 'Tidak ada perubahan yang dilakukan');
        }

        // SIMPAN PERUBAHAN USERNAME
        // authentikasi: cek apakah password yang dimasukkan sudah sama dengan password user
        if (!Hash::check($request->password, Auth::user()->password)) { //jika tidak sama...
            return back()->with('failed', 'Gagal menyimpan perubahan')
                ->withInput()
                ->withErrors(['password' => 'The password are incorrect.']);
        }

        // jika password yang diinput sama, simpan di db
        User::find(Auth::user()->id)->update(['email' => $validatedData['email']]);

        // kirim notifikasi via email - belum

        // kembalikan ke view
        return back()->with('success', 'Berhasil menyimpan perubahan');
    }

    // Update Password User
    public function updatePassword(Request $request)
    {
        // dd($request);
        // Validasi
        $validatedData = $request->validate([
            'oldPassword' => 'required|min:6',
            'newPassword1' => 'required|min:6|same:newPassword1',
            'newPassword2' => 'required|min:6|same:newPassword1'
        ]);

        // Cek apakah password lama benar
        if (!Hash::check($validatedData['oldPassword'], Auth::user()->password)) {
            return back()->with('failed', 'Gagal mengubah kata sandi')->withErrors(['oldPassword' => 'Old password are wrong, try again'])->withInput();
        }

        User::find(Auth::user()->id)->update(['password' => $validatedData['newPassword2']]);

        return back()->with('success', 'Kata sandi berhasil diubah');
    }

    // Update email user
    public function updateEmail(Request $request)
    {
        // validasi data
        $validatedData = $request->validate([
            'oldEmail' => 'required|email',
            'newEmail' => 'required|email|different:oldEmail|unique:users,email'
        ]);

        if ($validatedData['oldEmail'] != Auth::user()->email) {
            return back()->withErrors(['oldEmail' => 'Old email are wrong, try again'])->withInput();
        }

        // Kirimkan konfirmasi lewat email
        // Belom

        //Simpan perubahan - sementara, harus dipisah nantinya
        User::find(Auth::user()->id)->update(['email' => $validatedData['newEmail']]);
        return back()->with('success', 'Alamat email berhasil diperbarui');
    }
}
