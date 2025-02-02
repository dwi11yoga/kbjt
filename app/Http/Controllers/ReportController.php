<?php

namespace App\Http\Controllers;

use App\Models\Definisi;
use App\Models\EditKosakata;
use App\Models\Hukuman;
use App\Models\Kosakata;
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
                ->select('id', 'username', 'nama', 'role')
                ->where('id', '=', $d->user_id)
                ->first();
            $d->definisi = Definisi::withTrashed()
                ->select('id', 'kosakata_id', 'user_id', 'definisi', 'referensi', 'updated_at')
                ->where('id', '=', $d->definisi_id)
                ->first();
            $d->pengurus = User::withTrashed()
                ->select('id', 'nama', 'username', 'role', 'profile_pic', 'jenis_kelamin')
                ->where('id', '=', $d->pengurus_id)
                ->first();
            // dapatkan kosakata
            $d->kosakata = Kosakata::where('id', '=', $d->definisi->kosakata_id)->value('kosakata');
            $d->terlapor = User::where('id', '=', $d->definisi->user_id)->value('username');
        }

        // statistik dulu
        $statistik = new stdClass;
        $statistik->laporanTotal = Report::whereNotNull('definisi_id')->count();
        $statistik->laporanBlnIni = Report::whereNotNull('definisi_id')->whereMonth('created_at', '=', Carbon::now()->month)->count();
        $statistik->pending = Report::whereNotNull('definisi_id')->whereNull('status')->count();
        $statistik->selesai = Report::whereNotNull('definisi_id')->whereNotNull('status')->count();
        $statistik->ditanganiUser = Report::whereNotNull('definisi_id')->where('pengurus_id', '=', Auth::user()->id)->count();
        $statistik->ditanganiBlnIni = Report::whereNotNull('definisi_id')->where('pengurus_id', '=', Auth::user()->id)->whereMonth('status', '=', Carbon::now()->month)->count();

        // Permintaan ganti detail kosakata
        $editKosakata = EditKosakata::whereIn('id', function ($query) {
            $query->selectRaw('MAX(id)')
                ->from('editkosakata')
                ->groupBy('kosakata_id');
        })
            // ->whereNull('pengurus_id')
            ->with('kosakata:id,kosakata,slug')
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

        return view('dashboard.laporan', [
            'title' => 'Laporan',
            'group' => 'laporan',
            'definisi' => $laporan,
            'stat' => $statistik,
            'editKosakata' => $editKosakata,
            'kosakata' => $kosakata
        ]);
    }

    //laporkan definisi
    public function definisi(Request $request)
    {
        // cek apakah laporan sudah dilaporkan/belum
        $cek = Report::where('definisi_id', '=', $request->id)
            ->where('alasan', '=', $request->alasan)
            ->whereNull('status')
            ->first();
        if (isset($cek)) {
            return back()->with('failed', 'Laporan sudah dibuat')->withInput();
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

        Report::create($data);
        return back()->with('success', 'Definisi berhasil dilaporkan');
    }

    // laporkan kosakata
    public function kosakata(Request $request, $slug)
    {
        // dapatkan id kosakata
        $kosakata = Kosakata::where('slug', '=', $slug)->value('id');

        // cek apakah laporan sudah dilaporkan/belum
        $cek = Report::where('kosakata_id', '=', $kosakata)
            ->whereNull('status')
            ->first();
        if (isset($cek)) {
            return back()->with('failed', 'Permintaan menghapus kosakata sudah dibuat')->withInput();
        }

        // validasi
        $validatedData = $request->validate([
            'alasan' => 'required'
        ]);

        // simpan
        Report::create([
            'user_id' => Auth::user()->id,
            'kosakata_id' => $kosakata,
            'alasan' => $validatedData['alasan'],
            'catatan' => $request->catatan,
        ]);

        // kembali ke halaman
        return back()->with('success', 'Permintaan menghapus kosakata berhasil disubmit');
    }

    // Detail Laporan
    public function detailLaporan($id)
    {
        $laporan = Report::where('id', '=', $id)
            ->with('hukuman')
            ->first();
        $laporan->user = User::withTrashed()
            ->select('id', 'username', 'nama', 'role')
            ->where('id', '=', $laporan->user_id)
            ->first();

        if (isset($laporan->definisi_id)) {
            // jika definisi yang dilaporkan
            $laporan->definisi = Definisi::withTrashed()
                ->select('id', 'kosakata_id', 'user_id', 'definisi', 'referensi', 'updated_at')
                ->where('id', '=', $laporan->definisi_id)
                ->first();
            $laporan->author = User::withTrashed()
                ->select('id', 'nama', 'username', 'role', 'profile_pic', 'jenis_kelamin')
                ->where('id', '=', $laporan->definisi->user_id)
                ->first();
            $laporan->kosakata = Kosakata::select('id', 'kosakata', 'slug')->where('id', '=', $laporan->definisi->kosakata_id)->first();
        } elseif (isset($laporan->kosakata_id)) {
            // jika kosakata yang dilaporkan
            $laporan->kosakata = Kosakata::withTrashed()
                ->where('id', '=', $laporan->kosakata_id)
                ->first();
            $laporan->author = User::withTrashed()
                ->select('id', 'nama', 'username', 'role', 'profile_pic', 'jenis_kelamin')
                ->where('id', '=', $laporan->kosakata->user_id)
                ->first();
        }

        if (isset($laporan->pengurus_id)) {
            $laporan->pengurus = User::select('id', 'username', 'nama')->where('id', '=', $laporan->pengurus_id)->first();
        }

        $laporan->idZerofill = str_pad($laporan->id, 10, '0', STR_PAD_LEFT);

        // menentukan grup halaman
        $group = str_contains($_SERVER['REQUEST_URI'], 'kontribusi') == true ? 'kontribusi' : 'laporan';

        // jangan tampilkan jika user tidak berhak
        if ($group == 'kontribusi' && ($laporan->user_id != Auth::user()->id || $laporan->author->id)) {
            return view('error.403', [
                'title' => 'Akses ditolak'
            ]);
        }

        // data yang akan dikirimkan
        $data = [
            'title' => 'Laporan',
            'group' => $group,
            'laporan' => $laporan,
        ];

        if (isset($laporan->definisi_id)) {
            // preview definisi
            $definisi = new stdClass(); //inisiasi object definisi
            $definisi->menu = 12;
            $definisi->slug = $laporan->kosakata->slug;
            $definisi->kosakata = $laporan->kosakata->kosakata;
            $definisi->definisi = $laporan->def_dilaporkan;
            $definisi->referensi = $laporan->ref_dilaporkan;
            $definisi->updated_at = $laporan->waktu_definisi;
            $definisi->user = $laporan->author;
            $definisi->copies = 1;
            // cek apakah definisi yang asli sudah diupdate
            $definisi->updated = $laporan->def_dilaporkan == $laporan->definisi->definisi ? 1 : 0;
            $data['definisi'] = $definisi;
        } elseif (isset($laporan->kosakata_id)) {
            // preview kosakata
            $kosakata = Kosakata::withTrashed()
                ->where('id', '=', $laporan->kosakata_id)
                ->first();
            $data['kosakata'] = $kosakata;
        }

        return view('dashboard.laporan-detail', $data);
    }

    // Tindaklanjuti laporan
    public function tindaklanjut(Request $request, $id)
    {
        // dapatkan data laporan
        $laporan = Report::where('id', '=', $id)->first();

        // Cek apakah laporan yang dikirim sudah ditangani/belum (kuatir di inspect)
        if (isset($laporan->status)) {
            return back()->with('failed', 'Laporan sudah selesai ditangani oleh pengurus lain')->withInput();
        }

        // atur data hukuman
        if ($request->hukuman == 'tidak-ada') {
            $hukuman = 'Tidak ada';
            $hukuman_berakhir = null;
        } elseif ($request->hukuman == 'peringatan') {
            $hukuman = 'Peringatan';
            $hukuman_berakhir = null;
        } elseif ($request->hukuman == 'blokir') {
            $hukuman = 'Blokir akun pengguna';
            $hukuman_berakhir = null;
        } elseif ($request->hukuman == '3hr') {
            $hukuman = 'Suspend selama 3 hari';
            $hukuman_berakhir = Carbon::now()->addDays(3);
        } elseif ($request->hukuman == '7hr') {
            $hukuman = 'Suspend selama 7 hari';
            $hukuman_berakhir = Carbon::now()->addDays(7);
        } elseif ($request->hukuman == '14hr') {
            $hukuman = 'Suspend selama 14 hari';
            $hukuman_berakhir = Carbon::now()->addDays(14);
        } elseif ($request->hukuman == '30hr') {
            $hukuman = 'Suspend selama 30 hari';
            $hukuman_berakhir = Carbon::now()->addMonth();
        } else {
            $hukuman = null;
            $hukuman_berakhir = null;
        }

        $rules = [
            'pelanggaran' => 'required',
        ];

        if (isset($laporan->definisi_id)) {
            // tindaklanjut untuk definisi

            // validasi
            if ($request->pelanggaran == 'true') {
                $rules = array_merge($rules, [
                    'tindakanDefinisi' => 'required',
                    'hukuman' => 'required',
                ]);
            }
            $validatedData = $request->validate($rules);


            if ($validatedData['pelanggaran'] == 'true') {
                // simpan data hukuman ke tabel "Hukuman" (Jika ada)
                $data = [
                    'laporan_id' => $id,
                    'tindakan' => $validatedData['tindakanDefinisi'],
                    'hukuman' => $hukuman,
                    'hukuman_berakhir' => $hukuman_berakhir
                ];
                Hukuman::create($data);


                // tindakan untuk definisi (jika ada)
                $report = Report::where('id', '=', $id)->first();
                if ($validatedData['tindakanDefinisi'] == 'edit') {
                    Definisi::find($report->definisi_id)->update([
                        'hukuman_edit' => 1
                    ]);
                } elseif ($validatedData['tindakanDefinisi'] == 'hapus') {
                    Definisi::find($report->definisi_id)->delete();
                }

                // Jika user diblokir, maka hapus user
                if ($validatedData['hukuman'] == 'blokir') {
                    $definisi = Definisi::withTrashed()->select('id', 'user_id')->where('id', '=', $report->definisi_id)->first();
                    User::find($definisi->user_id)->delete();
                }
            }
        } elseif (isset($laporan->kosakata_id)) {
            // tindaklanjut untuk kosakata

            // validasi
            if ($request->pelanggaran == 'true') {
                $rules = array_merge($rules, [
                    'hukuman' => 'required',
                ]);
            }
            $validatedData = $request->validate($rules);

            // tindakan
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

        // kembali ke halaman detail laporan
        return back()->with('success', 'Tindakan berhasil disimpan');
    }
}
