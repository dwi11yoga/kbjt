<?php

namespace App\Http\Controllers;

use App\Models\HapusAkun;
use App\Models\User;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HapusAkunController extends Controller
{
    // view hapus akun
    public function index(){
        return view('dashboard.setting-hapusakun',[
            'title'=>'Hapus akun',
            'group'=>'settings'
        ]);
    }

    // fungsi hapus akun
    public function hapusAkun (Request $request){

        // validasi
        $validatedData=$request->validate([
            'alasan'=>'required|min:20',
            'password'=>'required|min:6|max:255',
            'konfirmasi1'=>'required',
            'konfirmasi2'=>'required',
        ]);

        // cek apakah password yang dimasukkan sudah benar
        if (!Hash::check($validatedData['password'], Auth::user()->password)) {
            return back()
            ->withErrors(['password'=>'Password are incorrect'])
            ->with('failed', 'Gagal menghapus akun')
            ->withInput();
        }

        // simpan alasan di db
        HapusAkun::create([
            'user_id'=>Auth::user()->id,
            'alasan'=>$validatedData['alasan']
        ]);

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
        return redirect('/')->with('success', "Akun kamu berhasil dihapus dari sistem :')");
    }
}
