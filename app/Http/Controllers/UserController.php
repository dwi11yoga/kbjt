<?php

namespace App\Http\Controllers;

use App\Mail\EmailBerubah;
use App\Mail\KataSandiBerubah;
use App\Mail\ResetPassword;
use App\Mail\ResetPasswordBerhasil;
use App\Mail\VerifikasiUserMail;
use App\Mail\WelcomeMail;
use App\Models\Achievement;
use App\Models\Blog;
use App\Models\Definisi;
use App\Models\EditKosakata;
use App\Models\Kosakata;
use App\Models\ResetPassword as ResetPasswordModel;
use App\Models\User;
use App\Models\VerifikasiUser;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules\File;
use Illuminate\Validation\ValidationException;

use Mail;
use Str;
use function Laravel\Prompts\error;

class UserController extends Controller
{
    public function __construct()
    {
        // increment kunjungan di statistik jika user hari ini baru mengunjungi halaman web (berdasarkan cookie)
        $this->statKunjungan();
    }

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

        // cek apakah user dihapus (soft delete). jika iya, maka alihkan ke halaman diblokir
        $cekAkun = User::withTrashed()
            ->where($fieldType, $credentials['user'])
            ->first();
        if ($cekAkun->trashed() && Hash::check($credentials['password'], $cekAkun->password)) { // jika user ditemukan dan password benar..
            return redirect()->to('/akses-gagal');
        }

        // cek apakah user sudah terverifikasi/belum
        if (empty($cekAkun->email_verified_at) && Hash::check($credentials['password'], $cekAkun->password)) { // jika verified email kosong dan password benar..
            // generate kode verifikasi random baru
            $kode = Str::upper(Str::random(6));

            // update data verifikasi user
            VerifikasiUser::where('user_id', $cekAkun->id)
                ->update([
                    'kode' => $kode,
                    'kedaluarsa' => Carbon::now()->addMinutes(5), // kedaluarsa dalam lima menit
                ]);

            // kirim kode verifikasi ke email
            $url = $this->getUrl();
            Mail::to($cekAkun->email)->send(new VerifikasiUserMail($cekAkun, $url, $kode));

            // arahkan ke halaman verifikasi
            return redirect()->to('/daftar/verifikasi');

        }

        // Authentikasi
        if (Auth::attempt([$fieldType => $credentials['user'], 'password' => $credentials['password']], $remember)) {

            $request->session()->regenerate(); //untuk mencegah serangan session fixation

            // cek achievement
            $userId = Auth::user()->id;

            // rule yang akan dicek achievementnya
            $rule = ['keanggotaan', 'definisi', 'kosakata', 'editKosakata', 'laporan', 'totalViewKosakata', 'viewKosakata'];
            if (Auth::user()->role == 'pengurus') { // tambahan rule khusus untuk pengurus
                $rulePengurus = ['artikel', 'totalViewBlog', 'viewBlog'];
                $rule = array_merge($rule, $rulePengurus);
            }

            foreach ($rule as $d) { //lakukan perulangan untuk cek achievement user
                $this->achievement($userId, $d);
            }

            // cek sertifikat (untuk notifikasi)
            $this->cekSertifikat($userId);

            return redirect()->intended('/dashboard');
        }


        return back()->with('failed', 'Username, email, atau password salah')->withInput();
    }

    // Logout
    public function logout(Request $request): RedirectResponse
    {
        Auth::logout(); // meng-logout-kan user
        $request->session()->invalidate(); //menghapus semua data session yang ada saat ini, mencegah session fixation attack.
        $request->session()->regenerateToken(); //mengganti CSRF token, Cross-Site Request Forgery
        return redirect('/');
    }

    // View Sign up (daftar)
    public function signup()
    {
        return view('homepage.signup', [
            'group' => 'login',
            'title' => 'Buat akun'
        ]);
    }

    //fungsi Buat akun (daftar)
    public function store(Request $request)
    {
        // validasi data
        $validatedData = $request->validate([
            'nama' => 'required|max:255',
            'email' => 'required|email:dns|unique:users,email',
            'username' => 'required|min:6|max:255|lowercase|unique:users,username|regex:/^[A-Za-z0-9_.]+$/',
            'password' => 'required|min:6|max:255|same:password2',
            'password2' => 'required|min:6|max:255|same:password',
            'eula' => 'required'
        ]);

        // simpan user
        $user = User::create($validatedData);
        // dd($user);

        // generate kode verifikasi random
        $kode = Str::upper(Str::random(6));

        // buat data verifikasi
        VerifikasiUser::create([
            'user_id' => $user->id,
            'kode' => $kode,
            'kedaluarsa' => Carbon::now()->addMinutes(5), // kedaluarsa dalam lima menit
        ]);

        // kirim kode verifikasi ke email
        $url = $this->getUrl();
        Mail::to($user->email)->send(new VerifikasiUserMail($user, $url, $kode));

        // arahkan ke halaman verifikasi
        return redirect()->to('/daftar/verifikasi');
    }

    // view verifikasi email
    // akan dijalankan setelah user mendaftarkan akunnya
    public function verifikasiUser()
    {
        return view('homepage.verifikasi-user', [
            'title' => 'Verifikasi email'
        ]);
    }

    // fungsi verifikasi user/email
    public function fungsiVerifikasiUser(Request $request)
    {
        // valisasi
        $validatedData = $request->validate([
            'kode' => 'required|size:6'
        ]);

        // cari datanya di database
        $dataVerifikasi = VerifikasiUser::where('kode', $validatedData['kode'])
            ->whereNull('status')
            ->where('kedaluarsa', '>', Carbon::now()) // belum kedaluarsa (yang tanggal kedaluarsanya lebih besar dari hari ini)
            ->first();

        // kembalikan jika data tidak ditemukan/kedaluarsa
        if (empty($dataVerifikasi)) {
            return back()->with('failed', 'Kode verifikasi tidak dikanali atau kedaluarsa')->withInput();
        }

        // tambah waktu verifikasi pada data user
        $user = User::find($dataVerifikasi->user_id);
        $user->update([
            'email_verified_at' => Carbon::now()
        ]);

        // update data verifikasi jadi sudah dipakai
        $dataVerifikasi->update([
            'status' => Carbon::now()
        ]);

        // increment nilai user baru pada tabel statistik
        $this->stat('user_baru');

        // buat notifikasi
        $pesan = 'Sugeng rawuh! Selamat datang di komunitas pelestari bahasa Jawa. 
        Baca dokumentasi berikut sebagai langkah awal dalam melestarikan bahasa jawa.';
        $url = '/cari?keyword=dokumentasi%3A&filter=artikel';
        $this->kirimNotifikasi($user->id, 'user', $pesan, $url);

        // kirim email selamat datang
        $url = $this->getUrl();
        Mail::to($user->email)->send(new WelcomeMail($user, $url));

        // redirect ke view login
        return redirect('/masuk')->with('success', 'Akun berhasil terdaftar, silahkan login');
    }


    // LUPA KATA SANDI
    // view lupa kata sandi (memasukkan username/email)
    public function lupaSandi()
    {
        return view('homepage.lupa-sandi', [
            'title' => 'Reset kata sandi',
        ]);
    }

    // fungsi Lupa Sandi
    public function fungsiLupaSandi(Request $request)
    {
        // Cek apakah username/email yang diinput user
        $fieldType = filter_var($request->user, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        // validasi
        if ($fieldType == 'email') {
            $rule = ['user' => 'required|email:dns'];
        } else {
            $rule = ['user' => 'required|min:6|max:255|regex:/^[A-Za-z0-9_.@-]+$/'];
        }
        $validatedData = $request->validate($rule);

        // cek apakah user ditemukan di db
        $user = User::where($fieldType, $request->user)->first();
        // dd(empty($user));

        if (empty($user)) { // jika user tidak ditemukan
            return back()->with('failed', 'Akun tidak ditemukan')->withInput();
        }

        // generate kode random untuk dikirim ke user
        $kode = Str::upper(Str::random(6));

        // simpan di database
        // jika user mengenerate ulang kode (kode sebelumnya belum kedaluarsa agar lebih efisien)
        $cek = ResetPasswordModel::where('user_id', $user->id)
            ->whereNull('status')
            ->where('kedaluarsa', '>', Carbon::now()) // yang belum kedaluarsa
            ->first();
        // dd($cek, empty($cek));
        if (empty($cek)) { // jika $cek kosong, maka buat data baru
            ResetPasswordModel::create([
                'user_id' => $user->id,
                'kode' => $kode,
                'kedaluarsa' => Carbon::now()->addMinutes(5)
            ]);
        } else { // jika $cek ada datanya, maka update data lama
            $cek->update([
                'kode' => $kode,
                'kedaluarsa' => Carbon::now()->addMinutes(5)
            ]);
        }

        // kirim email dengan kode verifikasi ke user
        $url = $this->getUrl();
        Mail::to($user->email)->send(new ResetPassword($user, $kode, $url));

        // redirect ke view 
        return redirect()->to('/reset-kata-sandi/autentikasi');
    }

    // view autentikasi reset kata sandi (masukkan kode) & ganti kata sandi
    public function autentikasiLupaSandi()
    {
        return view('homepage.lupa-sandi-kode', [
            'title' => 'Autentikasi reset kata sandi'
        ]);
    }

    // fungsi autentikasi reset kata sandi (masukkan kode) & ganti kata sandi baru
    public function fungsiAutentikasiLupaSandi(Request $request)
    {
        // validasi
        $validatedData = $request->validate([
            'kode' => 'required|size:6',
            'password1' => 'required|min:6|same:password2',
            'password2' => 'required|min:6|same:password1',
        ]);

        // cari data reset password
        $data = ResetPasswordModel::where('kode', $request->kode)
            ->where('kedaluarsa', '>', Carbon::now()) // belum kedaluarsa (yang tanggal kedaluarsanya lebih besar dari hari ini)
            ->first();

        // jika tidak ada data, maka kembalikan
        if (empty($data)) {
            return back()->with('failed', 'Permintaan reset tidak ditemukan atau kedaluarsa')->withInput();
        }

        // ganti kata sandi akun
        $user = User::find($data->user_id);
        $user->update([
            'password' => $request->password1 // tidak perlu di hash karena sudah diatur hash di model
        ]);

        // update status reset kata sandi
        $data->update([
            'status' => Carbon::now(),
        ]);

        // buat notifikasi
        $pesan = 'Kata sandi akun kamu berhasil direset';
        $this->kirimNotifikasi($user->id, 'akun', $pesan, '#');

        // kirim email
        $url = $this->getUrl();
        Mail::to($user->email)->send(new ResetPasswordBerhasil($user, $url));

        // kembalikan ke halaman login
        return redirect()->to('/masuk')->with('success', 'Kata sandi berhasil direset');
    }





    // Profil user
    public function profile($username)
    {
        // Data user
        $user = User::where('username', $username)->first();

        // jika data user tida ditemukan, maka alihkan
        if (is_null($user)) {
            return $this->error404();
        }

        $user['level'] = $this->levelCalculator($user['id']);
        // url user
        $user['url'] = $this->getUrl() . '/u/' . $user['username'];

        // Hitung jumlah data medsos - untuk membatasi jumlah medsos yang ditampilkan
        $user['jmlMedsos'] = 0;
        if (isset($user['media_sosial'])) {
            $user['jmlMedsos'] = count(array_filter($user['media_sosial'], function ($value) {
                return $value !== null && $value != "";
            }));
        }

        $definisi = Definisi::where('user_id', $user->id);
        // jika user bukan user yang sedang login, maka sembunyikan definisi yang disembunyikan karena hukuman
        // tampilkan jika definisi==null || hukuman edit bukan 1
        if (isset(Auth::user()->id) && Auth::user()->id != $user->id) {
            $definisi = $definisi->where(function ($query) {
                $query->whereNull('hukuman_edit')
                    ->orWhere('hukuman_edit', '!=', 1);
            });
        }

        $definisi = $definisi->whereHas('kosakata')
            ->with('kosakata')
            ->with('pengurus')
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

        // dapatkan data edit kosakata oleh user
        $editKosakata = EditKosakata::where('user_id', $user->id)
            ->whereNotNull('status')
            ->whereHas('kosakata')
            ->with('kosakata')
            ->orderBy('updated_at', 'desc')
            ->paginate(10, ['*'], 'kosakata-page')
            ->appends(request()->query());

        $kirim = [
            'title' => $user['nama'] . ' ' . '(' . $username . '',
            'user' => $user,
            'definisi' => $definisi,
            'kosakata' => $kosakata,
            'editKosakata' => $editKosakata,
            'group' => 'Profil user',
        ];

        // dapatkan daftar artikel by user
        if ($user['role'] == 'pengurus') {
            $posts = Blog::select('id', 'judul', 'slug', 'user_id', 'status', 'updated_at', 'thumbnail')
                ->with('user:id,username,nama')
                ->where('user_id', '=', $user['id'])
                ->whereNotNull('status')
                ->orderBy('updated_at', 'desc')
                ->paginate(10, ['*'], 'artikel-page')
                ->appends(request()->query());
            $kirim['posts'] = $posts;
        }

        // dapatkan data achievement user (jika ada)
        if (isset($user->achievement)) {
            $achieved = $user->achievement;
            $achievement = Achievement::whereIn('id', array_keys($achieved))->get();
            // tambahkan kapan achievement tsb didapatkan
            foreach ($achievement as $d) {
                $d->progress = '100%';
                $d->date_achieved = Carbon::parse($achieved[$d->id])->timezone('Asia/Jakarta');
            }
            $kirim['achievement'] = $achievement;
        }

        // dapatkan data banner
        $banner = $this->getBanner([1, 2]);
        $kirim['banner'] = $banner;

        // incremenet nilai view jika pengguna hari ini belom melihat akun
        if (!Cookie::has('user_' . $user->id)) { // jika belum ada cookie = user belum melihat halaman ini
            User::find($user->id)->increment('view', 1); // naikkan view
            Cookie::queue('user_' . $user->id, true, 24 * 60); // buat cookie (kedaluarsa dalam 1 hari)
        }

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
    public function ubahEmail()
    {
        return view('dashboard.setting-ubahemail', [
            'title' => 'Ubah alamat email',
            'group' => 'settings'
        ]);
    }

    // fungsi update ubah email
    public function simpanUbahEmail(Request $request)
    {
        // validasi
        $validatedData = $request->validate([
            'email' => 'required|email:dns|unique:users,email,' . Auth::user()->id . ',id',
            'password' => 'required|min:6|max:255',
        ]);

        // jika email yang dimasukkan sama (tidak berubah), kembalikan ke view
        if ($validatedData['email'] == Auth::user()->email) {
            return back()->with('success', 'Tidak ada perubahan yang dilakukan');
        }

        // authentikasi: cek apakah password yang dimasukkan sudah sama dengan password user
        if (!Hash::check($request->password, Auth::user()->password)) { //jika tidak sama...
            return back()->with('failed', 'Gagal menyimpan perubahan')
                ->withInput()
                ->withErrors(['password' => 'The password are incorrect.']);
        }

        // simpan di db
        User::find(Auth::user()->id)->update(['email' => $validatedData['email']]);

        // kirim notifikasi ke email lama
        $url = $this->getUrl();
        Mail::to(Auth::user()->email)
            ->send(new EmailBerubah(Auth::user(), $validatedData['email'], $url));

        // kembalikan ke view
        return back()->with('success', 'Berhasil menyimpan perubahan');
    }

    // view ubah password user
    public function ubahPassword()
    {
        return view('dashboard.setting-ubahpassword', [
            'title' => 'Ubah Kata sandi',
            'group' => 'settings'
        ]);
    }
    // fungsi Update Password User
    public function updatePassword(Request $request)
    {
        // dd($request);
        // Validasi
        $validatedData = $request->validate([
            'oldPassword' => 'required|min:6|max:255',
            'newPassword1' => 'required|min:6|max:255|same:newPassword1',
            'newPassword2' => 'required|min:6|max:255|same:newPassword1'
        ]);

        // Cek apakah password lama benar
        if (!Hash::check($validatedData['oldPassword'], Auth::user()->password)) {
            return back()->with('failed', 'Gagal mengubah kata sandi')
                ->withErrors(['oldPassword' => 'Old password are incorrect'])
                ->withInput();
        }

        // simpan ke db
        $user = User::find(Auth::user()->id);
        $user->update(['password' => $validatedData['newPassword2']]);

        // kirim notifikasi lewat email
        $url = $this->getUrl();
        Mail::to($user->email)->send(new KataSandiBerubah($user, $url));

        // kembali ke view
        return back()->with('success', 'Kata sandi berhasil diubah');
    }

    // promosikan/demosi sebagai pengurus
    public function ubahStatusPengurus($userId)
    {
        // periksa kembali apakah role user == kepala
        // Tidak perlu, sudah ada middleware

        // ambil data user
        $user = User::find($userId);

        if ($user->role == 'pengurus') {
            // jika user==pengurus, maka ubah menjadi kontributor
            $ubahJadi = 'kontributor';
            $pesan = 'Mohon maaf, status dan hak istimewa kamu sebagai pengurus telah dicabut oleh Kepala.';
            $url = '#';
            $toast = $user->nama . ' berhasil didemosikan sebagai pengurus';
        } elseif ($user->role == 'kontributor') {
            // jika user==kontributor, maka ubah menjadi pengurus
            $ubahJadi = 'pengurus';
            $pesan = 'Selamat! Kepala telah mempromosikan kamu menjadi pengurus 🥳. Lihat apa saja yang bisa kamu lakukan sebagai pengurus di sini.';
            $url = '/blog/post/hak-istimewa-pengurus';
            $toast = $user->nama . ' berhasil dipromosikan menjadi pengurus';
        } else {
            // selain itu, maka alihkan ke halaman 404. karena pasti user yang coba diubah usernya adalah kepala
            return $this->error404();
        }

        // ubah data di database
        User::find($userId)->update([
            'role' => $ubahJadi,
        ]);

        // kirim notifikasi ke user
        $this->kirimNotifikasi($userId, 'kepengurusan', $pesan, $url);

        // kembalikan kepala ke view
        return back()->with('success', $toast);
    }
}
