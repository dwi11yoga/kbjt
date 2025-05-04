<?php

namespace App\Http\Controllers;

use App\Models\Achievement;
use App\Models\Blog;
use App\Models\Definisi;
use App\Models\EditKosakata;
use App\Models\Kosakata;
use App\Models\Report;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AchievementController extends Controller
{
    //view achievement (dashboard)
    public function index()
    {

        // CEK ACHIEVEMENT 
        // rule yang akan dicek achievementnya
        $rule = ['keanggotaan', 'definisi', 'kosakata', 'editKosakata', 'laporan', 'totalViewKosakata', 'viewKosakata'];
        if (Auth::user()->role == 'pengurus') { // tambahan rule khusus untuk pengurus
            $rulePengurus = ['artikel', 'totalViewBlog', 'viewBlog'];
            $rule = array_merge($rule, $rulePengurus);
        }
        //lakukan perulangan untuk cek achievement user
        foreach ($rule as $d) {
            $this->achievement(Auth::user()->id, $d);
        }


        // dapatkan data achievement yang didapatkan oleh user
        $achieved = User::find(Auth::user()->id)->achievement; // menggunakan query builder karena menggunakan facade Auth ada delay

        // data overview / statistik
        if (Auth::user()->role == 'kontributor') {
            $totalAchievement = Achievement::where('role', '!=', 'pengurus')
                ->orWhereNull('role')
                ->count();
        } else {
            $totalAchievement = Achievement::count();
        }
        $overview = [
            'achievement' => count(is_array($achieved) ? $achieved : []),
            'total' => $totalAchievement,
        ];
        $overview['persentase'] = $this->persentase($overview['achievement'], $overview['total']);

        // dapatkan data achievement
        if (isset($achieved)) { // jika user sudah mendapat achievement, maka tampilkan lebih dulu
            if (Auth::user()->role == 'kontributor') { // jika user==kontributor
                $achievement = Achievement::where('role', '=', Auth::user()->role)
                    ->orWhereNull('role')
                    ->orderByRaw('FIELD(id,' . implode(',', array_keys($achieved)) . ') DESC'); // agar achievement yang sudah didapatkan akan ditampilkan lebih dulu
            } else { //selain itu, tampilkan semua achievement
                $achievement = Achievement::orderByRaw('FIELD(id,' . implode(',', array_keys($achieved)) . ') DESC'); // agar achievement yang sudah didapatkan akan ditampilkan lebih dulu
            }
        } else { // jika user belum mendapatkan achievement...
            if (Auth::user()->role == 'kontributor') { // jika user==kontributor
                $achievement = Achievement::where('role', '!=', 'pengurus')
                    ->orWhereNull('role');
            } else { //selain itu, tampilkan semua achievement
                $achievement = Achievement::select('*');
            }
        }

        $achievement = $achievement->orderBy('rule', 'asc')
            ->orderBy('requirement', 'asc')
            ->paginate(20)
            ->onEachSide(2)
            ->appends(request()->query());

        foreach ($achievement as $d) {
            // cek apakah achievement sudah didapatkan (untuk ditampilkan)
            if (isset($achieved[$d->id])) {
                $d->achieved = 1;
                $d->date_achieved = Carbon::parse($achieved[$d->id])->timezone('Asia/Jakarta');
                $d->progress = '100%';
            } else {

                // cek jumlah kontribusi user
                if ($d->rule == 'keanggotaan') {
                    // cek lama suer bergabung
                    $value = round(Auth::user()->created_at->diffInDays(now())) ?? 0;
                } elseif ($d->rule == 'definisi') {
                    // cek jumlah definisi yang dibuat oleh user
                    $value = Definisi::where('user_id', '=', Auth::user()->id)->count() ?? 0;
                } elseif ($d->rule == 'kosakata') {
                    // cek jumlah kosakata yang dibuat oleh user
                    $value = Kosakata::where('user_id', '=', Auth::user()->id)->count() ?? 0;
                } elseif ($d->rule == 'editKosakata') {
                    // cek jumlah kosakata yang diedit oleh user (dan di acc oleh pengurus)
                    $value = EditKosakata::where('user_id', '=', Auth::user()->id)->whereNotNull('status')->count() ?? 0;
                } elseif ($d->rule == 'laporan') {
                    // cek jumlah laporan yang dibuat oleh user dan diacc oleh pengurus
                    $value = Report::where('user_id', '=', Auth::user()->id)->whereNotNull('status')->count() ?? 0;
                } elseif ($d->rule == 'artikel') {
                    // cek jumlah artikel yang dibuat oleh user dan dipublikasikan
                    $value = Blog::where('user_id', '=', Auth::user()->id)->whereNotNull('status')->count() ?? 0;
                } elseif ($d->rule == 'totalViewKosakata') {
                    // cek jumlah view dari semua kosakata yang dibuat oleh user
                    $value = Kosakata::where('user_id', '=', Auth::user()->id)->sum('view') ?? 0;
                } elseif ($d->rule == 'viewKosakata') {
                    // cek jumlah view dari 1 kosakata paling banyak dilihat yang dibuat oleh user
                    $value = Kosakata::where('user_id', '=', Auth::user()->id)->orderBy('view', 'desc')->value('view') ?? 0;
                } elseif ($d->rule == 'totalViewBlog') {
                    // cek jumlah view dari semua artikel yang dibuat oleh user
                    $value = Blog::where('user_id', '=', Auth::user()->id)->sum('view') ?? 0;
                } elseif ($d->rule == 'viewBlog') {
                    // cek jumlah view dari 1 artikel paling banyak dilihat yang dibuat oleh user
                    $value = Blog::where('user_id', '=', Auth::user()->id)->orderBy('view', 'desc')->value('view') ?? 0;
                } else {
                    $value = 0;
                }

                $d->progress = round(($value / $d->requirement) * 100) . '%';
            }
        }

        return view('dashboard.achievement', [
            'group' => 'achievement',
            'title' => 'Achievement',
            'overview' => $overview,
            'achievement' => $achievement
        ]);
    }

    // View tambah achievement
    public function tambah()
    {
        return view('dashboard.achievement-tambah', [
            'title' => 'Achievement baru',
            'group' => 'achievement'
        ]);
    }

    // simpan achievement baru
    public function save(Request $request)
    {
        // validasi
        $validatedData = $request->validate([
            'nama' => 'required|min:3|unique:achievements,nama',
            'role' => 'required',
            'deskripsi' => 'required',
            'rule' => 'required',
            'requirement' => 'required|numeric|min:0',
            'reward' => 'required|numeric|min:0',
            'emblem' => 'required|mimes:png,jpg,webp,jpeg|image|max:1024|dimensions:ratio=1/1',
        ]);

        if ($validatedData['role'] == 'semua') {
            $validatedData['role'] = null;
        }

        // simpan
        // simpan gambar
        $gambar = $request->file('emblem')->store('achievement');
        $validatedData['emblem'] = $gambar;
        // simpan data ke database
        Achievement::create($validatedData);

        // kembalikan ke halaman achieevement
        return redirect()->to('/achievement')->with('success', 'Achievement baru berhasil disimpan');
    }

    // View edit achievement
    public function edit($id)
    {
        // dapatkan data achievement
        $achievement = Achievement::find($id);
        if ($achievement->role == null) {
            $achievement->role = 'semua';
        }

        // tampilkan
        return view('dashboard.achievement-edit', [
            'title' => 'Edit achievement',
            'group' => 'achievement',
            'achievement' => $achievement
        ]);
    }

    // simpan edit
    public function simpanEdit(Request $request, $id)
    {

        $rules = [
            'nama' => 'required|min:3|unique:achievements,nama,' . $id . ',id',
            'role' => 'required',
            'deskripsi' => 'required',
            'rule' => 'required',
            'requirement' => 'required|numeric|min:0',
            'reward' => 'required|numeric|min:0',
        ];
        if (isset($request->emblem)) {
            $rules['emblem'] = 'mimes:png,jpg,webp,jpeg|image|max:1024|dimensions:ratio=1/1';
        }

        // validasi
        $validatedData = $request->validate($rules);

        if ($validatedData['role'] == 'semua') {
            $validatedData['role'] = null;
        }

        // gambar
        if (isset($request->emblem)) {
            // hapus gambar semelumnya
            $emblem = Achievement::where('id', $id)->value('emblem');
            if (isset($emblem)) {
                Storage::delete($emblem);
            }
            // simpan gambar baru
            $validatedData['emblem'] = $request->file('emblem')->store('achievement');
        }

        // simpan
        Achievement::find($id)->update($validatedData);

        // kembalikan ke halaman achieevement
        return redirect()->to('/achievement')->with('success', 'Achievement berhasil diperbarui');
    }
}
