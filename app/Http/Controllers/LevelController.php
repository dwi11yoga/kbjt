<?php

namespace App\Http\Controllers;

use App\Models\Level;
use App\Models\PoinKontribusi;
use App\Models\User;
use Illuminate\Http\Request;

class LevelController extends Controller
{
    // Halaman level
    public function index()
    {
        // Level
        $level = Level::select('*')->orderBy('lvl', 'desc')->get();
        $user = User::select('id', 'poin')->get();
        $jml_user = $user->count();

        foreach ($level as $d) {
            // Hitung banyaknya user dengan level tertentu
            $d['user_total'] = $user->filter(function ($u) use ($d) {
                return $u->poin >= $d->min_poin;
            })->count();

            // Hapus user dari $user jika user sudah mendapatkan level
            $user = $user->reject(function ($u) use ($d) {
                return $u->poin >= $d->min_poin;
            });

            // Hitung persentase
            $d['persentase'] = number_format(($d['user_total'] / $jml_user) * 100, 1, ',');
            $d['min_poin'] = number_format($d['min_poin'], 0, ',', '.');
        }

        // Poin kontribusi
        $kontribusiKontributor = PoinKontribusi::where('role', '=', 'kontributor')->get();
        $kontribusiPengurus = PoinKontribusi::where('role', '=', 'pengurus')->get();

        return view('dashboard.level', [
            'title' => 'Level & Poin',
            'group' => 'level',
            'level' => $level,
            'kontribusiKontributor' => $kontribusiKontributor,
            'kontribusiPengurus' => $kontribusiPengurus
        ]);
    }

    // Simpan level baru
    public function create(Request $request)
    {
        // validasi data
        $validatedData = $request->validate([
            'lvl' => 'required|integer|min:1|unique:levels,lvl',
            'min_poin' => 'required|integer'
        ]);

        // cek min_level apakah lebih kecil dari level dibawahnya atau lebih besar daripada level diatasnya
        $poinSebelumnya = Level::where('lvl', '=', $request->lvl - 1)->first();
        $poinSetelahnya = Level::where('lvl', '=', $request->lvl + 1)->first();
        if (isset($poinSebelumnya['min_poin']) && $validatedData['min_poin'] <= $poinSebelumnya['min_poin']) {
            return back()->with('failed', 'Gagal menyimpan level')
                ->withErrors(['min_poin' => 'min poin smaller than previous level'])
                ->withInput();
        } elseif (isset($poinSetelahnya) && $validatedData['min_poin'] >= $poinSetelahnya['min_poin']) {
            return back()->with('failed', 'Gagal menyimpan level')
                ->withErrors(['min_poin' => 'min_poin greater than the next level'])
                ->withInput();
        }

        // simpan level
        Level::create($validatedData);
        return back()->with('success', 'Level berhasil ditambahkan');
    }

    // Update level
    public function update(Request $request)
    {
        // validasi data
        $validatedData = $request->validate([
            'editLvl' => 'required|integer|min:1|exists:levels,lvl|unique:levels,lvl,' . $request->editLvl . ',lvl',
            'editMinPoin' => 'required|integer'
        ]);

        // cek min_level apakah lebih kecil dari level dibawahnya atau lebih besar daripada level diatasnya
        $poinSebelumnya = Level::where('lvl', '=', $request->editLvl - 1)->first();
        $poinSetelahnya = Level::where('lvl', '=', $request->editLvl + 1)->first();
        if (isset($poinSebelumnya['min_poin']) && $validatedData['editMinPoin'] <= $poinSebelumnya['min_poin']) {
            return back()->with('failed', 'Gagal menyimpan perubahan')
                ->withErrors(['editMinPoin' => 'min_poin smaller than previous level'])->withInput();
        } elseif (isset($poinSetelahnya) && $validatedData['editMinPoin'] >= $poinSetelahnya['min_poin']) {
            return back()->with('failed', 'Gagal menyimpan perubahan')
                ->withErrors(['editMinPoin' => 'min_poin greater than the next level'])->withInput();
        }

        // simpan
        Level::where('lvl', '=', $validatedData['editLvl'])
            ->update(['min_poin' => $validatedData['editMinPoin']]);

        // kembalikan ke halaman tsb
        return back()->with('success', 'Level berhasil diedit');
    }
}
