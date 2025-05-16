<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Definisi;
use App\Models\EditKosakata;
use App\Models\Kosakata;
use App\Models\Notifikasi;
use App\Models\Report;
use App\Models\Sertifikat;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class SertifikatController extends Controller
{
    public function __construct(){
        // increment kunjungan di statistik jika user hari ini baru mengunjungi halaman web (berdasarkan cookie)
        $this->statKunjungan();
    }
    
    // view alaman sertifikat
    public function index()
    {
        // dapatkan data sertifikat
        if (Auth::user()->role == 'kontributor') {
            $sertifikat = Sertifikat::where('role', '!=', 'pengurus')->orWhereNull('role');
        } else {
            $sertifikat = Sertifikat::select('*');
        }

        $sertifikat = $sertifikat->orderBy('rule', 'asc')
            ->orderBy('requirement', 'asc')
            ->paginate(20)
            ->onEachSide(2)
            ->appends(request()->query());

        // cek apakah sudah didapat/belum & hitung progress
        if (Auth::user()->role != 'kepala') {
            $didapat = Auth::user()->sertifikat;
            foreach ($sertifikat as $d) {
                foreach (array_keys(is_array($didapat) ? $didapat : []) as $a) {
                    if ($d->id == $a) {
                        $d->didapat = 1;
                        $d->tglDiperoleh = Carbon::parse($didapat[$a])->setTimezone('Asia/Jakarta');
                        $d->persentase = '100%';
                    }
                }

                if (empty($d->didapat)) { // if-else ditaruh diluar foreach array keys agar dijalankan ketika $didapat adalah null/array kosong
                    if ($d->rule == 'keanggotaan') { // hitung lama user terdaftar
                        $nilai = Auth::user()->created_at->diffInDays(now());
                    } elseif ($d->rule == 'kontribusi') { // hitung kontribusi user
                        $kosakata = Kosakata::where('user_id', Auth::user()->id)->count();
                        $editKosakata = EditKosakata::where('user_id', Auth::user()->id)->whereNotNull('status')->count();
                        $definisi = Definisi::where('user_id', Auth::user()->id)->count();
                        $laporan = Report::with('hukuman')->where('user_id', Auth::user()->id)->whereNotNull('status')->whereHas('hukuman')->count();
                        $nilai = $kosakata + $editKosakata + $definisi + $laporan;
                    } elseif ($d->rule == 'kontribusiPengurus') { // hitung kontribusi user pengurus
                        $editKosakata = EditKosakata::where('pengurus_id', Auth::user()->id)->whereNotNull('status')->count();
                        $definisi = Definisi::where('verifikasi_oleh', Auth::user()->id)->count();
                        $laporan = Report::where('pengurus_id', Auth::user()->id)->whereNotNull('status')->count();
                        // banner - belom
                        $banner = 0;
                        $blog = Blog::where('user_id', Auth::user()->id)->whereNotNull('status')->count();
                        $nilai = $editKosakata + $definisi + $laporan + $blog + $banner;
                    } else {
                        $nilai = 0;
                    }

                    $d->progress = round($nilai);
                    if ($nilai > $d->requirement) {
                        $d->persentase = '100%';

                        // buat notifikasi, namun pastikan dulu agar notifikasi tidak dobel
                        $pesan = 'Kamu berhak untuk meng-klaim sertifikat karena ' . strtolower($d->nama) . ' 🎉';
                        $url = '/sertifikat';
                        $cekNotifikasi = Notifikasi::where('user_id', Auth::user()->id)
                            ->where('message', $pesan)
                            ->orderBy('created_at', 'desc')
                            ->first();
                        if (empty($cekNotifikasi) == true) {
                            $this->kirimNotifikasi(Auth::user()->id, 'sertifikat', $pesan, $url);
                        }
                    } else {
                        $d->persentase = $this->persentase($nilai, $d->requirement);
                    }
                }
                // $d->progress = 1000;
            }
        }

        // dd($sertifikat);
        return view('dashboard.sertifikat', [
            'group' => 'sertifikat',
            'title' => 'Sertifikat',
            'sertifikat' => $sertifikat
        ]);
    }

    // klaim sertifikat
    public function klaim($id)
    {
        // cek apakah user sudah memiliki sertifikat tsb
        $sertifDimiliki = Auth::user()->sertifikat;
        if (isset($sertifDimiliki)) {
            foreach (array_keys($sertifDimiliki) as $d) {
                if ($d == $id) {
                    return back()->with('failed', 'Tidak dapat mengklaim kembali sertifikat yang sudah dimiliki');
                }
            }
        }

        // cek kembali apakah user berhak menerima sertifikat
        $sertifikat = Sertifikat::find($id);
        $totalKontribusi = $this->hitungRequirementSertifikat($sertifikat->rule, Auth::user()->id);

        if (round($totalKontribusi) < $sertifikat->requirement) {
            return back()->with('failed', 'Kamu belum memenuhi syarat untuk mengklaim sertifikat ini');
        }

        // simpan sertifikat
        $sertifDimiliki[$id] = now();
        User::find(Auth::user()->id)->update(['sertifikat' => $sertifDimiliki]);

        // kirimkan notifikasi
        $pesan = 'Kamu berhasil meng-klaim sertifikat karena ' . strtolower($sertifikat->nama) . '(+' . $sertifikat->reward . ' poin)';
        $url = '/sertifikat';
        $this->kirimNotifikasi(Auth::user()->id, 'sertifikat', $pesan, $url);

        return back()->with('success', 'Sertifikat berhasil diklaim');
    }

    // View detail sertifikat
    public function detailSertufikat($userId, $sertifikatId)
    {
        // dapatkan data dari db
        $user = User::select('nama', 'username', 'id', 'sertifikat')->where('username', $userId)->first();
        $user->idZerofill = str_pad($user->id, 10, '0', STR_PAD_LEFT);

        // tampilkan halaman eerror jika user belum dapat sertifikat
        if (empty($user->sertifikat[$sertifikatId])) {
            return $this->error404();
        }

        // dapatkan data sertifikat
        $sertifikat = Sertifikat::find($sertifikatId);
        $sertifikat->didapat = Carbon::parse($user->sertifikat[$sertifikat->id])->setTimezone('Asia/Jakarta')->translatedFormat('d F Y');

        // dapatkan data kepala
        $kepala = User::select('nama')->where('role', 'kepala')->first();

        // generate qr code menggunakan simple qrcode (untuk membuktikan bahwa sertifikatnya asli)
        $url = $this->getUrl() . '/sertifikat/' . $user->username . '/' . $sertifikat->id;
        $qrcode = QrCode::size(112)->generate($url);

        // tampilkan view
        return view('homepage.sertifikat-view', [
            'title' => 'Sertifikat ' . $user->nama,
            'sertifikat' => $sertifikat,
            'user' => $user,
            'kepala' => $kepala,
            'qrcode' => $qrcode
        ]);
    }

    // view tambah sertifikat
    public function tambah()
    {
        return view('dashboard.sertifikat-tambah', [
            'title' => 'Sertifikat baru',
            'group' => 'sertifikat'
        ]);
    }

    // Simpan tambah sertifikat
    public function simpanTambah(Request $request)
    {

        // validasi
        $rules = [
            'nama' => 'required|min:6|unique:sertifikat,nama',
            'role' => 'required',
            'requirement' => 'required|numeric|min:1',
            'reward' => 'required|numeric|min:0',
        ];
        if ($request->role != 'pengurus') {
            $rules['rule'] = 'required|not_in:kontribusiPengurus';
        } else {
            $rules['rule'] = 'required';
        }
        $validatedData = $request->validate($rules);

        // ubah role 'semua' jadi null
        if ($validatedData['role'] == 'semua') {
            $validatedData['role'] = null;
        }

        // simpan di database
        Sertifikat::create($validatedData);

        // kembali ke halaman sertifikat
        return redirect()->to('/sertifikat')->with('success', 'Sertifikat baru berhasil disimpan');
    }

    // view edit sertifikat
    public function edit($id)
    {
        // dapatkan data 
        $sertifikat = Sertifikat::find($id);

        // alihkan ke tampilan 404 jika data tidak ditemukan
        if (empty($sertifikat)) {
            return $this->error404();
        }

        // ubah null jadi 'semua'
        if (empty($sertifikat->role)) {
            $sertifikat->role = 'semua';
        }

        return view('dashboard.sertifikat-edit', [
            'title' => 'Edit sertifikat',
            'group' => 'sertifikat',
            'sertifikat' => $sertifikat
        ]);
    }

    // simpan edit
    public function simpanEdit(Request $request, $id)
    {
        // dd($request);
        // validasi
        $rules = [
            'nama' => 'required|min:6|unique:sertifikat,nama,' . $id . ',id',
            'role' => 'required',
            'requirement' => 'required|numeric|min:1',
            'reward' => 'required|numeric|min:0',
        ];
        if ($request->role != 'pengurus') {
            $rules['rule'] = 'required|not_in:kontribusiPengurus';
        } else {
            $rules['rule'] = 'required';
        }
        $validatedData = $request->validate($rules);

        // ubah role 'semua' jadi null
        if ($validatedData['role'] == 'semua') {
            $validatedData['role'] = null;
        }

        // simpan perubahan
        Sertifikat::find($id)->update($validatedData);

        // kembalikan ke tampilan
        return redirect()->to('/sertifikat')->with('success', 'Perubahan berhasil disimpan');
    }
}
