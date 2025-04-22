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
        
        // id user yang akan dicek achievementnya
        $user=Auth::user()->id;
        // periksa semua rule achievement
        $rule = [
            'keanggotaan',
            'definisi',
            'kosakata',
            'editKosakata',
            'laporan',
            'artikel',
            'totalViewKosakata',
            'totalViewBlog',
            'viewKosakata',
            'viewBlog'
        ];

        foreach ($rule as $d) { // lakukan perulangan untuk tiap rule
            // hitung progress user
            if ($d == 'keanggotaan') {
                $nilai = round(Auth::user()->created_at->diffInDays(now()));
            } elseif ($d == 'definisi') {
                $nilai = Definisi::where('user_id', '=', $user)->count();
            } elseif ($d == 'kosakata') {
                $nilai = Kosakata::where('user_id', '=', $user)->count();
            } elseif ($d == 'editKosakata') {
                $nilai = EditKosakata::where('user_id', '=', $user)->whereNotNull('pengurus_id')->count();
            } elseif ($d == 'laporan') {
                $nilai = Report::where('user_id', '=', $user)->whereNotNull('pengurus_id')->count();
            } elseif ($d == 'artikel') {
                $nilai = Blog::where('user_id', '=', $user)->whereNotNull('status')->count();
            } elseif ($d == 'totalViewKosakata') {
                $nilai = Kosakata::where('user_id', '=', $user)->sum('view');
            } elseif ($d == 'totalViewBlog') {
                $nilai = Blog::where('user_id', '=', $user)->sum('view');
            } elseif ($d == 'viewKosakata') {
                $nilai = Kosakata::where('user_id', '=', $user)->orderBy('view', 'desc')->value('view');
            } elseif ($d == 'viewBlog') {
                $nilai = Blog::where('user_id', '=', $user)->orderBy('view', 'desc')->value('view');
            } else {
                $nilai = 0;
            }

            // periksa apakah user berhak mendapat achievement.
            $this->achievement($user, $d, $nilai);
        }

        
        // dapatkan data achievement yang didapatkan oleh user
        $achieved = User::find(Auth::user()->id)->value('achievement'); // menggunakan query builder karena menggunakan facade Auth ada delay

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
            ->paginate(20)
            ->onEachSide(2)
            ->appends(request()->query());

        foreach ($achievement as $d) {
            // cek apakah achievement sudah didapatkan (untuk ditampilkan)
            foreach (array_keys(is_array($achieved) ? $achieved : []) as $i) {
                if ($d->id == $i) {
                    $d->achieved = 1;
                    $d->date_achieved = Carbon::parse($achieved[$i])->timezone('Asia/Jakarta');
                    $d->progress = '100%';
                }
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
