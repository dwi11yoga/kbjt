<?php

namespace App\Http\Controllers;

use App\Models\Definisi;
use App\Models\EditKosakata;
use App\Models\Hukuman;
use App\Models\Kosakata;
use App\Models\Level;
use App\Models\Report;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use stdClass;

class ReportController extends Controller
{
    // Tampilan halaman laporan
    public function index()
    {
        // Laporan (definisi)
        $laporan = Report::select('id', 'user_id', 'definisi_id', 'pengurus_id', 'status', 'alasan', 'created_at', 'updated_at')
            ->with([
                'definisi' => function ($query) {
                    $query->withTrashed(); //ambil data softdelete juga
                }
            ])
            ->whereNotNull('definisi_id');

        // filter
        if (isset(request()->filter) && request()->filter == 'belum-ditangani') {
            $laporan = $laporan->whereNull('status');
        } elseif (isset(request()->filter) && request()->filter == 'selesai-ditangani') {
            $laporan = $laporan->whereNotNull('status');
        } elseif (isset(request()->filter) && request()->filter == 'kamu-tangani') {
            $laporan = $laporan->where('pengurus_id', '=', Auth::user()->id);
        }
        $laporan = $laporan->orderBy('updated_at', 'desc')
            ->paginate(10, '*', 'definisi')
            ->onEachSide(2)
            ->appends(request()->query());

        foreach ($laporan as $d) {
            // dibuat seperti ini agar tidak error ketika ada user/definisi yang dihapus
            $d->user = User::withTrashed()
                ->select('id', 'username', 'nama', 'role', 'jenis_kelamin', 'profile_pic')
                ->where('id', '=', $d->user_id)
                ->first();
            $d->definisi = Definisi::withTrashed()
                ->select('id', 'kosakata_id', 'user_id', 'definisi', 'referensi', 'updated_at')
                ->where('id', '=', $d->definisi_id)
                ->first();
            $d->pengurus = User::withTrashed()
                ->select('id', 'nama', 'username', 'role', 'profile_pic', 'jenis_kelamin', 'deleted_at')
                ->where('id', '=', $d->pengurus_id)
                ->first();

            // cek apakah data user (pengurus) ada/terhapus
            if ($d->pengurus && $d->pengurus->trashed()) {
                $d->pengurus->statusUser = 'dihapus';
            }

            // dapatkan kosakata
            $d->kosakata = Kosakata::where('id', '=', $d->definisi->kosakata_id)->value('kosakata');
            $d->terlapor = User::where('id', '=', $d->definisi->user_id)->value('username');
        }

        // Permintaan ganti detail kosakata
        $editKosakata = EditKosakata::whereIn('id', function ($query) {
            $query->selectRaw('MAX(id)')
                ->from('editkosakata')
                ->groupBy('kosakata_id'); // kelompokkan agar permintaan edit kosakata tidak duplikat
        })
            // ->whereNull('pengurus_id')
            ->with('kosakata', function ($query) {
                $query->withTrashed(); // ambi data softdelete juga
            })
            ->orderBy('updated_at', 'desc')
            ->paginate(10, '*', 'edit-kosakata')
            ->onEachSide(2)
            ->appends(request()->query());

        // Permintaan hapus kosakata
        $kosakata = Report::select('id', 'user_id', 'kosakata_id', 'pengurus_id', 'status', 'alasan', 'created_at', 'updated_at')
            // ->with('kosakata:id,kosakata')
            ->with([
                'kosakata' => function ($query) {
                    $query->withTrashed(); //ambil data softdelete juga
                }
            ])
            ->whereNotNull('kosakata_id');

        // filter
        if (isset(request()->filterKosakata) && request()->filterKosakata == 'belum-ditangani') {
            $kosakata = $kosakata->whereNull('status');
        } elseif (isset(request()->filterKosakata) && request()->filterKosakata == 'selesai-ditangani') {
            $kosakata = $kosakata->whereNotNull('status');
        } elseif (isset(request()->filterKosakata) && request()->filterKosakata == 'kamu-tangani') {
            $kosakata = $kosakata->where('pengurus_id', '=', Auth::user()->id);
        }
        $kosakata = $kosakata->orderBy('updated_at', 'desc')
            ->paginate(10, '*', 'hapus-kosakata')
            ->onEachSide(2)
            ->appends(request()->query());

        foreach ($kosakata as $d) {
            // dibuat seperti ini agar tidak error ketika ada user/definisi yang dihapus
            $d->user = User::withTrashed()
                ->select('id', 'username', 'nama', 'role', 'jenis_kelamin', 'profile_pic')
                ->where('id', '=', $d->user_id)
                ->first();
            $d->pengurus = User::withTrashed()
                ->select('id', 'nama', 'username', 'role', 'profile_pic', 'jenis_kelamin', 'deleted_at')
                ->where('id', '=', $d->pengurus_id)
                ->first();

            // cek apakah data user (pengurus) ada/terhapus
            if ($d->pengurus && $d->pengurus->trashed()) {
                $d->pengurus->statusUser = 'dihapus';
            }
        }

        // dd($kosakata);

        // statistik dulu
        $statistik = new stdClass;
        $statistik->laporanTotal = Report::count();
        $statistik->laporanBlnIni = Report::whereYear('created_at', Carbon::now()->year)->whereMonth('created_at', '=', Carbon::now()->month)->count();
        $statistik->pending = Report::whereNull('status')->count();
        $statistik->selesai = Report::whereNotNull('status')->count();
        $statistik->ditanganiUser = Report::where('pengurus_id', '=', Auth::user()->id)->count();
        $statistik->ditanganiBlnIni = Report::where('pengurus_id', '=', Auth::user()->id)->whereYear('created_at', Carbon::now()->year)->whereMonth('status', '=', Carbon::now()->month)->count();

        return view('dashboard.laporan', [
            'title' => 'Laporan',
            'group' => 'laporan',
            'definisi' => $laporan,
            'stat' => $statistik,
            'editKosakata' => $editKosakata,
            'kosakata' => $kosakata
        ]);
    }

    //fungsi laporkan definisi
    public function definisi(Request $request)
    {
        // cek apakah laporan sudah dilaporkan/belum
        $cek = Report::where('definisi_id', $request->id)
            ->whereNull('pengurus_id')
            ->first();

        if (isset($cek)) {
            return back()->with('failed', 'Definisi sudah dilaporkan oleh pengguna lain')->withInput();
        }

        // validasi
        if (empty($request->alasan)) {
            return back()->with('failed', 'Gagal menyimpan laporan, coba lagi')->withInput()->withErrors(['alasan' => 'alasan field is required']);
        }
        $validatedData = $request->validate([
            'alasan' => 'required'
        ]);
        if (empty($request->id)) {
            return back()->with('failed', 'Gagal menyimpan laporan, coba lagi')->withInput();
        }

        // dapatkan data definisi
        $definisi = Definisi::select('id', 'definisi', 'referensi', 'updated_at')->where('id', '=', $request->id)->first();

        // Simpan ke database
        $data = [
            'user_id' => Auth::user()->id,
            'definisi_id' => request()->id,
            'alasan' => $validatedData['alasan'],
            'def_dilaporkan' => $definisi->definisi,
            'ref_dilaporkan' => $definisi->referensi,
            'waktu_definisi' => $definisi->updated_at
        ];
        if (isset($request->catatan)) {
            $data['catatan'] = $request->catatan;
        }

        $laporan = Report::create($data);

        // kembalikan ke view
        if (Auth::user()->role == 'pengurus') {
            return redirect('/laporan/' . $laporan->id)->with('success', 'Form laporan berhasil dibuat, silahkan ditindaklanjuti');
        } else {
            return back()->with('success', 'Definisi berhasil dilaporkan');
        }
    }

    // fungsi laporkan kosakata
    public function kosakata(Request $request, $slug)
    {
        // dapatkan id kosakata
        $kosakata = Kosakata::where('slug', '=', $slug)->value('id');

        // cek apakah laporan sudah dilaporkan/belum
        $cek = Report::where('kosakata_id', '=', $kosakata)
            ->whereNull('status')
            ->first();
        if (isset($cek)) {
            return back()->with('failed', 'Kosakata sudah dilaporkan oleh pengguna lain')->withInput();
        }

        // validasi
        $validatedData = $request->validate([
            'alasan' => 'required'
        ]);

        // simpan
        $laporan = Report::create([
            'user_id' => Auth::user()->id,
            'kosakata_id' => $kosakata,
            'alasan' => $validatedData['alasan'],
            'catatan' => $request->catatan,
        ]);

        // kembalikan ke view
        if (Auth::user()->role == 'pengurus') {
            return redirect('/laporan/' . $laporan->id)->with('success', 'Form laporan berhasil dibuat, silahkan ditindaklanjuti');
        } else {
            return back()->with('success', 'Permintaan menghapus kosakata berhasil disubmit');
        }
    }

    // Detail Laporan
    public function detailLaporan($id)
    {
        // ambil data laporan
        $laporan = Report::where('id', '=', $id)
            ->with('hukuman')
            ->first();

        // alihkan jika data laporan tidak ditemukan
        if (empty($laporan)) {
            return $this->error404();
        }


        // ambil data yang melaporkan
        $laporan->user = User::withTrashed()
            ->select('id', 'username', 'nama', 'role', 'poin', 'created_at', 'deleted_at')
            ->where('id', '=', $laporan->user_id)
            ->first();

        // cek apakah data user terhapus/tidak
        if ($laporan->user->trashed()) {
            $laporan->user->statusUser = 'dihapus';
        }

        // ambil data definisi/kosakata dan author
        if (isset($laporan->definisi_id)) {
            // jika definisi yang dilaporkan
            $laporan->definisi = Definisi::withTrashed()
                ->select('id', 'kosakata_id', 'user_id', 'definisi', 'referensi', 'updated_at')
                ->where('id', '=', $laporan->definisi_id)
                ->first();
            $laporan->author = User::withTrashed()
                ->where('id', '=', $laporan->definisi->user_id)
                ->first();
            // cek apakah data pengurus terhapus/tidak
            if ($laporan->author->trashed()) {
                $laporan->author->statusUser = 'dihapus';
            }

            $laporan->kosakata = Kosakata::withTrashed()
                ->where('id', '=', $laporan->definisi->kosakata_id)
                ->first();
        } elseif (isset($laporan->kosakata_id)) {
            // jika kosakata yang dilaporkan
            $laporan->kosakata = Kosakata::withTrashed()
                ->where('id', '=', $laporan->kosakata_id)
                ->first();
            $laporan->author = User::withTrashed()
                ->where('id', '=', $laporan->kosakata->user_id)
                ->first();

            // cek apakah data pengurus terhapus/tidak
            if ($laporan->author->trashed()) {
                $laporan->author->statusUser = 'dihapus';
            }
        }

        // alihkan jika user tidak berhak
        if (Auth::user()->role == 'kontributor' && $laporan->user_id != Auth::user()->id && $laporan->author->id != Auth::user()->id) {
            return $this->error403();
        }

        // ambil data pengurus
        if (isset($laporan->pengurus_id)) {
            $laporan->pengurus = User::withTrashed()
                ->select('id', 'username', 'nama', 'deleted_at')->where('id', '=', $laporan->pengurus_id)
                ->first();

            // cek apakah data pengurus terhapus/tidak
            if ($laporan->pengurus->trashed()) {
                $laporan->pengurus->statusUser = 'dihapus';
            }
        }

        // buat id zerofill
        $laporan->idZerofill = str_pad($laporan->id, 10, '0', STR_PAD_LEFT);

        // set group
        if (Auth::user()->role != 'kontributor') {
            $group = 'laporan';
        } elseif ($laporan->user_id == Auth::user()->id) {
            $group = 'kontribusi';
        } else {
            $group = '';
        }

        // data yang akan dikirimkan
        $data = [
            'title' => 'Detail Laporan',
            'group' => $group,
            'laporan' => $laporan,
        ];

        // statistik pelapor dan terlapor
        if (empty($laporan->status)) { //jalankan jika laporan belum ditindaklanjuti
            // pelapor
            $pelapor['lvl'] = $this->levelCalculator($laporan->user->poin);
            $pelapor['totalLaporan'] = Report::where('user_id', $laporan->user_id)->count(); //Definisi & Kosakata dilaporkan pelapor
            $pelapor['laporanBersalahDilaporkan'] = Report::where('user_id', $laporan->user_id)->whereHas('hukuman')->count(); //Definisi & Kosakata terbukti bersalah yang dilaporkan pelapor
            $pelapor['jmlLaporanBlnIni'] = Report::where('user_id', $laporan->user_id)->whereMonth('created_at', Carbon::now()->month)->count(); //Definisi & Kosakata dilaporkan bulan ini
            $pelapor['bergabung'] = $laporan->user->created_at->translatedFormat('d F Y');
            $data['detailPelapor'] = $pelapor;

            // terlapor
            $terlapor['totalLaporan'] = Report::whereHas('definisi', function ($query) use ($laporan) {
                $query->where('user_id', $laporan->author->id);
            })->orWhereHas('kosakata', function ($query) use ($laporan) {
                $query->where('user_id', $laporan->author->id);
            })->count(); //Jumlah dilaporkan pengguna lain

            $kodeDefinisi = Report::whereHas('hukuman')->whereHas('definisi', function ($query) use ($laporan) {
                $query->where('user_id', $laporan->author->id);
            });
            $kodeKosakata = Report::whereHas('hukuman')->WhereHas('kosakata', function ($query) use ($laporan) {
                $query->where('user_id', $laporan->author->id);
            });
            $terlapor['laporanBersalahDilaporkan'] = (clone $kodeDefinisi)->count() + (clone $kodeKosakata)->count(); //Jumlah dinyatakan bersalah

            $terlapor['jmlLaporanBlnIni'] = (clone $kodeDefinisi)->whereHas('hukuman', function ($query) use ($laporan) {
                $query->whereNot('hukuman', 'peringatan');
            })->count() +
                (clone $kodeKosakata)->whereHas('hukuman', function ($query) use ($laporan) {
                    $query->whereNot('hukuman', 'peringatan');
                })
                    ->count(); //Jumlah hukuman yang pernah diterima

            $terlapor['lvl'] = $this->levelCalculator($laporan->author->poin);
            $terlapor['bergabung'] = $laporan->author->created_at->translatedFormat('d F Y');

            $data['detailTerlapor'] = $terlapor;

            // riwayat hukuman terlapor
            $riwayatHukuman = Report::with([
                'definisi' => function ($query) {
                    $query->withTrashed();
                }
            ])
                ->with([
                    'kosakata' => function ($query) {
                        $query->withTrashed();
                    }
                ])
                ->with('hukuman')
                ->with('user:username,nama,id')
                ->whereNotNull('pengurus_id')
                ->where(function ($query) use ($laporan) {
                    $query->whereHas('definisi', function ($subQuery) use ($laporan) {
                        $subQuery->where('user_id', $laporan->author->id);
                    })->orWhereHas('kosakata', function ($subQuery) use ($laporan) {
                        $subQuery->where('user_id', $laporan->author->id);
                    });
                })
                ->orderby('status', 'desc')
                ->limit(5)
                ->get();

            // jika data riwayat hukuman adalah dari definisi, maka cari kosakatanya
            foreach ($riwayatHukuman as $d) {
                if (!empty($d->definisi)) {
                    $d->definisi->kosakata = Kosakata::find($d->definisi->kosakata_id)->kosakata;
                }
            }
            // dd($riwayatHukuman);
            $data['riwayatHukuman'] = $riwayatHukuman;
        }


        // hitung berapa poin yang dikurangi jika hukuman yang diberikan adalah pengurangan poin
        $persentasePoinDikurang = [2, 5, 8, 10, 15, 20];
        foreach ($persentasePoinDikurang as $d) {
            $hasilPenguranganPoin[$d] = (int) round($laporan->author->poin - (($laporan->author->poin * $d) / 100)); //bulatkan
        }
        $data['hasilPenguranganPoin'] = $hasilPenguranganPoin;

        return view('dashboard.laporan-detail', $data);
    }

    // Tindaklanjuti laporan definisi dan kosakata
    public function tindaklanjut(Request $request, $id)
    {
        // dapatkan data laporan
        $laporan = Report::where('id', '=', $id)
            ->with('definisi:id,user_id')
            ->with('kosakata:id,user_id')
            ->first();

        // alihkan jika laporan yang dikirim sudah ditangani oleh pengurus lain (kuatir di inspect)
        if (isset($laporan->status)) {
            return back()->with('failed', 'Laporan sudah selesai ditangani oleh pengurus lain')->withInput();
        }

        // alihkan jika pihak terlapor yang menangani laporan (jika definisi/kosakata yang dilaporkan adalah milik admin, ini bisa terjadi)
        if (!empty($laporan->definisi) && Auth::user()->id == $laporan->definisi->user_id || (!empty($laporan->kosakata) && Auth::user()->id == $laporan->kosakata->user_id)) {
            return $this->error403();
        }

        // Validasi
        $rules = ['pelanggaran' => 'required'];

        if (isset($laporan->definisi_id)) { // validasi untuk definisi

            // validasi
            if ($request->pelanggaran == 'true') {
                $rules = array_merge($rules, [
                    'tindakanDefinisi' => 'required',
                    'hukuman' => 'required',
                ]);
            }
        } elseif (isset($laporan->kosakata_id)) { // validasi untuk kosakata

            // validasi
            if ($request->pelanggaran == 'true') {
                $rules = array_merge($rules, [
                    'hukuman' => 'required',
                ]);
            }
        }

        $validatedData = $request->validate($rules);

        // atur data hukuman
        if ($request->hukuman == 'tidak-ada') { // jika tidak diberi hukuman
            $hukuman = 'Tidak ada';
            $hukuman_berakhir = null;

        } elseif ($request->hukuman == 'peringatan') { // jika hukumannya hanya peringatan
            $hukuman = 'Peringatan';
            $hukuman_berakhir = null;

        } elseif (substr($request->hukuman, 0, 11) == 'kurangiPoin') { // jika hukumannya pengurangan poin
            // dapatkan data terlapor
            if (isset($laporan->definisi_id)) {
                $userId = Definisi::find($laporan->definisi_id)->user_id;
            } elseif (isset($laporan->kosakata_id)) {
                $userId = Kosakata::find($laporan->kosakata_id)->user_id;
            }
            $userPoin = User::find($userId)->poin;

            // hitung poin yang dikurangi
            $persentase = intval(substr($request->hukuman, 11, 3));
            $poinDikurangi = ($userPoin * $persentase) / 100; // jumlah poin yang akan dikurangi dari poin milik user.
            $hasil = round($userPoin - $poinDikurangi);

            // simpan hasil pengurangan
            User::find($userId)->update(['poin' => $hasil]);

            // data yang akan disimpan
            $hukuman = 'Penguranagan poin sebesar ' . $persentase . '%, dari ' . $userPoin . ' menjadi ' . $hasil;
            $hukuman_berakhir = null;

        } elseif ($request->hukuman == 'blokir') { // jika hukumannya memblokir akun author
            $hukuman = 'Blokir akun pengguna';
            $hukuman_berakhir = null;

        } elseif ($request->hukuman == '3hr') { // jika hukumannya suspend selama 3 hari
            $hukuman = 'Suspend selama 3 hari';
            $hukuman_berakhir = Carbon::now()->addDays(3);
        } elseif ($request->hukuman == '7hr') { // jika hukumannya suspend selama 7 hari
            $hukuman = 'Suspend selama 7 hari';
            $hukuman_berakhir = Carbon::now()->addDays(7);
        } elseif ($request->hukuman == '14hr') { // jika hukumannya suspend selama 14 hari
            $hukuman = 'Suspend selama 14 hari';
            $hukuman_berakhir = Carbon::now()->addDays(14);
        } elseif ($request->hukuman == '30hr') { // jika hukumannya suspend selama 30 hari
            $hukuman = 'Suspend selama 30 hari';
            $hukuman_berakhir = Carbon::now()->addMonth();
        } else { // selain itu
            $hukuman = null;
            $hukuman_berakhir = null;
        }

        // tindakan
        if (isset($laporan->definisi_id)) { // tindaklanjut untuk definisi

            if ($validatedData['pelanggaran'] == 'true') { // simpan data hukuman ke tabel "Hukuman" (Jika ada)
                $data = [
                    'laporan_id' => $id,
                    'tindakan' => $validatedData['tindakanDefinisi'],
                    'hukuman' => $hukuman,
                    'hukuman_berakhir' => $hukuman_berakhir
                ];
                Hukuman::create($data);


                // tindakan untuk definisi (jika ada)
                if ($validatedData['tindakanDefinisi'] == 'edit') {
                    Definisi::find($laporan->definisi_id)->update([
                        'hukuman_edit' => 1, // maka definisi tidak akan ditampilkan di web
                        'verifikasi' => null, // cabut status terverifikasi
                        'verifikasi_oleh' => null
                    ]);
                } elseif ($validatedData['tindakanDefinisi'] == 'hapus') {
                    Definisi::find($laporan->definisi_id)->delete();
                }

                // Jika user diblokir, maka hapus user
                if ($validatedData['hukuman'] == 'blokir') {
                    $definisi = Definisi::withTrashed()->select('id', 'user_id')->where('id', '=', $report->definisi_id)->first();
                    User::find($definisi->user_id)->delete();
                }
            }

        } elseif (isset($laporan->kosakata_id)) { // tindaklanjut untuk hapus kosakata

            if ($validatedData['pelanggaran'] == 'true') {
                // hapus kosakata
                Kosakata::find($laporan->kosakata_id)->delete();

                // Jika user diblokir, maka hapus user
                if ($validatedData['hukuman'] == 'blokir') {
                    $terlapor = Kosakata::where('id', '=', $laporan->kosakata_id)->value('user_id');
                    User::find($terlapor)->delete();
                }

                // simpan data hukuman
                Hukuman::create([
                    'laporan_id' => $id,
                    'tindakan' => 'hapus',
                    'hukuman' => $hukuman,
                    'hukuman_berakhir' => $hukuman_berakhir
                ]);
            }
        }

        // ubah status laporan
        Report::find($id)->update([
            'status' => Carbon::now(),
            'pengurus_id' => Auth::user()->id,
            'catatan_pengurus' => $request->catatan
        ]);

        // KIRIM NOTIFIKASI
        $pelapor = User::select('id', 'nama')
            ->where('id', $laporan->user_id)
            ->first();
        $terlapor = User::select('id', 'nama')
            ->where('id', $laporan->definisi->user_id ?? $laporan->kosakata->user_id)
            ->first();
        $dilaporkan = isset($laporan->definisi_id) ? 'definisi' : 'kosakata';
        $url = '/laporan/' . $id;

        // untuk pelapor

        // jika pelapor == yang menindaklanjuti laporan, maka tidak perlu dikirimi notifikasi
        if (Auth::user()->id != $pelapor->id) {
            $pesan = 'Laporan kamu atas ' . $dilaporkan . ' yang disubmit oleh ' . $terlapor->nama . ' telah selesai ditangani';
            $this->kirimNotifikasi($pelapor->id, 'laporan', $pesan, $url);
        }
        // untuk terlapor
        $pesan = 'Seseorang melaporkan ' . $dilaporkan . ' yang kamu submit';
        $this->kirimNotifikasi($terlapor->id, 'laporan', $pesan, $url);

        // cek achievement
        // cek apakah pelapor mendapatkan achievement berdasarkan jumlah laporan yang didapat
        $this->achievement($laporan->user_id, 'laporan');

        // kembali ke halaman detail laporan
        return back()->with('success', 'Tindakan berhasil disimpan');
    }
}
