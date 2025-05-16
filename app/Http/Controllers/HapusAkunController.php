<?php

namespace App\Http\Controllers;

use App\Models\HapusAkun;
use App\Models\User;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Mail;

class HapusAkunController extends Controller
{
    public function __construct(){
        // increment kunjungan di statistik jika user hari ini baru mengunjungi halaman web (berdasarkan cookie)
        $this->statKunjungan();
    }
    
    // view hapus akun (form)
    public function index()
    {
        return view('dashboard.setting-hapusakun', [
            'title' => 'Hapus akun',
            'group' => 'settings'
        ]);
    }

    // fungsi hapus akun
    public function hapusAkun(Request $request)
    {

        // validasi
        $validatedData = $request->validate([
            'alasan' => 'required|min:20',
            'password' => 'required|min:6|max:255',
            'konfirmasi1' => 'required',
            'konfirmasi2' => 'required',
        ]);

        // cek apakah password yang dimasukkan sudah benar
        if (!Hash::check($validatedData['password'], Auth::user()->password)) {
            return back()
                ->withErrors(['password' => 'Password are incorrect'])
                ->with('failed', 'Gagal menghapus akun')
                ->withInput();
        }

        // simpan alasan di db
        HapusAkun::create([
            'user_id' => Auth::user()->id,
            'alasan' => $validatedData['alasan']
        ]);

         // increment akun dihapus di statistik
         $this->stat('akun_dihapus');

        // kirim email notifikasi ke user
        $url = $this->getUrl();
        Mail::to(Auth::user()->email)->send(new \App\Mail\HapusAkun(Auth::user(), $url));

        // hapus akun
        // User::find(Auth::user()->id)->delete();
        Auth::user()->delete();

        // meng-logout-kan user
        Auth::logout();
        //menghapus semua data session yang ada saat ini, mencegah session fixation attack.
        $request->session()->invalidate();
        //mengganti CSRF token, Cross-Site Request Forgery
        $request->session()->regenerateToken();
        // alihkan ke homepage
        return redirect('/')->with('success', "Selamat tinggal, akun kamu berhasil dihapus");
    }

    // view detail user yang menghapus akun
    public function detail($id)
    {
        // dapatkan data user dan alasan user menghapus akun
        $alasan = HapusAkun::with('user')->find($id);
        $user = $alasan->user;

        // buat id jadi zerofill
        $user->idZeroFill = str_pad($alasan->user_id, 10, '0', STR_PAD_LEFT);

        // hitung total kontibusi user sebagai kontributor
        $user->kontribusi=$this->hitungRequirementSertifikat('kontribusi', $user->id);
        if ($user->role=='pengurus') {
            $user->kontribusi=$user->kontribusi+$this->hitungRequirementSertifikat('kontribusiPengurus', $user->id);
        }

        // dd($user->achievement);
        // total achievement
        $user->totalAchievement=count($user->achievement ?? []);

        // total sertifikat
        $user->totalSertifikat=count($user->sertifikat ?? []);



        return view('dashboard.detail-user-dihapus', [
            'title' => 'Laporan akun dihapus',
            'group' => $user->role,
            'user' => $user,
            'alasan'=>$alasan
        ]);
    }
}
