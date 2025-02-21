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

class AchievementController extends Controller
{
    //view achievement (dashboard)
    public function index()
    {
        // achievement yang didapatkan
        $achieved = Auth::user()->achievement;
        // data overview
        if (Auth::user()->role == 'kontributor') {
            $totalAchievement = Achievement::where('role', '!=', 'pengurus')
                ->orWhereNull('role')
                ->count();
        } else {
            $totalAchievement = Achievement::count();
        }

        $overview = [
            // 'achievement' => 17, //sementara
            'achievement' => count(is_array($achieved) ? $achieved : []),
            'total' => $totalAchievement,
        ];
        $overview['persentase'] = $this->persentase($overview['achievement'], $overview['total']);

        // data achievement
        if (isset($achieved)) {
            if (Auth::user()->role == 'kontributor') {
                $achievement = Achievement::where('role', '=', Auth::user()->role)
                    ->orWhereNull('role')
                    ->orderByRaw('FIELD(id,' . implode(',', array_keys($achieved)) . ') DESC'); // agar achievement yang sudah didapatkan akan ditampilkan lebih dulu
            } else {
                $achievement = Achievement::orderByRaw('FIELD(id,' . implode(',', array_keys($achieved)) . ') DESC'); // agar achievement yang sudah didapatkan akan ditampilkan lebih dulu
            }
        } else {
            if (Auth::user()->role == 'kontributor') {
                $achievement = Achievement::where('role', '!=', 'pengurus')
                    ->orWhereNull('role');
            } else {
                $achievement = Achievement::select('*');
            }
        }

        $achievement = $achievement->orderBy('rule', 'asc') //sementara, diganti berdasarkan sing wis diunlock
            ->paginate(20)
            ->onEachSide(2)
            ->appends(request()->query());

        // simpan achievement yang sudah didapat
        $simpan = $achieved;
        $poin = 0;

        foreach ($achievement as $d) {
            // cek apakah achievement sudah didapatkan
            foreach (array_keys(is_array($achieved) ? $achieved : []) as $i) {
                if ($d->id == $i) {
                    $d->achieved = 1;
                    $d->date_achieved = Carbon::parse($achieved[$i]);
                    $d->progress = '100%';
                }
            }

            // hitung progress
            if (empty($d->achieved) || $d->achieved == 0) {
                $nilai = 0;
                if ($d->rule == 'keanggotaan') {
                    $nilai = round(Auth::user()->created_at->diffInDays(now()));
                } elseif ($d->rule == 'definisi') {
                    $nilai = Definisi::where('user_id', '=', Auth::user()->id)->count();
                } elseif ($d->rule == 'kosakata') {
                    $nilai = Kosakata::where('user_id', '=', Auth::user()->id)->count();
                } elseif ($d->rule == 'editKosakata') {
                    $nilai = EditKosakata::where('user_id', '=', Auth::user()->id)->whereNotNull('pengurus_id')->count();
                } elseif ($d->rule == 'laporan') {
                    $nilai = Report::where('user_id', '=', Auth::user()->id)->whereNotNull('pengurus_id')->count();
                } elseif ($d->rule == 'artikel') {
                    $nilai = Blog::where('user_id', '=', Auth::user()->id)->whereNotNull('status')->count();
                } elseif ($d->rule == 'totalViewKosakata') {
                    $nilai = Kosakata::where('user_id', '=', Auth::user()->id)->sum('view');
                } elseif ($d->rule == 'totalViewBlog') {
                    $nilai = Blog::where('user_id', '=', Auth::user()->id)->sum('view');
                } elseif ($d->rule == 'viewKosakata') {
                    $kosakata = Kosakata::select('view')->where('user_id', '=', Auth::user()->id)->get();
                    foreach ($kosakata as $k) {
                        if ($k->view > $nilai) {
                            $nilai = $k->view;
                        }
                    }
                } elseif ($d->rule == 'viewBlog') {
                    $blog = Blog::select('view')->where('user_id', '=', Auth::user()->id)->get();
                    foreach ($blog as $k) {
                        if ($k->view > $nilai) {
                            $nilai = $k->view;
                        }
                    }
                }

                // jika nilai lebih besar daripada requirement
                if ($nilai >= $d->requirement) {
                    // simpan achievement baru
                    $simpan[$d->id] = now();
                    $poin = $poin + $d->reward;

                    // tambahkan status pada achievement yang ditampilkan
                    $d->achieved = 1;
                    $d->date_achieved = now();
                    $d->progress = '100%';

                    // hitung lagi data overview
                    $overview['achievement'] = $overview['achievement'] + 1;
                    $overview['persentase'] = $this->persentase($overview['achievement'], $overview['total']);

                    // atur agar nilai tidak melebihi nilai total(agar persentase tidak lebih dari 100%)
                    $nilai = $d->requirement;
                }

                if ($d->requirement != 0) {
                    $d->progress = $this->persentase($nilai, $d->requirement);
                } else {
                    $d->progress = '100%';
                }
            }
        }

        // simpan achivement baru (jika ada)
        if ($simpan != $achieved) {
            User::find(Auth::user()->id)->update([
                'achievement' => $simpan
            ]);
            User::find(Auth::user()->id)->increment('poin', $poin);
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
            'emblem' => '',
        ]);

        if ($validatedData['role'] == 'semua') {
            $validatedData['role'] = null;
        }

        // simpan
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
        // validasi
        $validatedData = $request->validate([
            'nama' => 'required|min:3|unique:achievements,nama,' . $id . ',id',
            'role' => 'required',
            'deskripsi' => 'required',
            'rule' => 'required',
            'requirement' => 'required|numeric|min:0',
            'reward' => 'required|numeric|min:0',
            'emblem' => '',
        ]);

        if ($validatedData['role'] == 'semua') {
            $validatedData['role'] = null;
        }

        // simpan
        Achievement::find($id)->update($validatedData);

        // kembalikan ke halaman achieevement
        return redirect()->to('/achievement')->with('success', 'Achievement baru berhasil disimpan');
    }
}
