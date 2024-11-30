<?php

namespace App\Http\Controllers;

use App\Models\Level;
use Illuminate\Support\Facades\Auth;

abstract class Controller
{
    // Untuk menghitung level
    public function levelCalculator($point)
    {
        $levelSets = Level::select(['lvl', 'min_poin'])->orderBy('lvl', 'desc')->get();
        foreach ($levelSets as $d) {
            if ($point >= $d->min_poin) {
                return $d->lvl;
            }
        }
    }

    // Untuk mengetahui progress user
    public function progressCalculator($point)
    {
        $level = $this->levelCalculator($point);
        $levelSets = Level::select(['lvl', 'min_poin'])->orderBy('lvl', 'desc')->get();

        $syaratNaikLvl = $levelSets->firstWhere('lvl', $level + 1)?->min_poin; // ? untuk agar ketika null tidak error
        $minPoin = $levelSets->firstWhere('lvl', $level)->min_poin;
        if ($syaratNaikLvl == null) {
            return 100;
        } else {
            return intval((($point - $minPoin) / ($syaratNaikLvl - $minPoin)) * 100);
        }
    }
}
