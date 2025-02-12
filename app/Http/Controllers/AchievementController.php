<?php

namespace App\Http\Controllers;

use App\Models\Achievement;
use Illuminate\Http\Request;

class AchievementController extends Controller
{
    //view achievement (dashboard)
    public function index()
    {
        // data overview
        $overview = [
            'achievement' => 17, //sementara
            'total' => Achievement::count(),
        ];
        $overview['persentase'] = $this->persentase($overview['achievement'], $overview['total']);

        // data achievement
        $achievement = Achievement::orderBy('achievement', 'asc') //sementara, diganti berdasarkan sing wis diunlock
            ->paginate(20)
            ->onEachSide(2)
            ->appends(request()->query());

        return view('dashboard.achievement', [
            'group' => 'achievement',
            'title' => 'Achievement',
            'overview' => $overview,
            'achievement' => $achievement
        ]);
    }
}
