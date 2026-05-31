<?php

use Livewire\Component;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Title;
use App\Models\User;

new class extends Component {
    #[Title('Hall of Fame')]
    #[Computed]
    public function users()
    {
        $users = User::select('id', 'username', 'poin', 'created_at', 'jenis_kelamin', 'profile_pic') //
            ->orderBy('poin', 'desc')
            ->limit(99)
            ->get();

        foreach ($users as $user) {
            $user->level = levelCalculator($user->poin);
            $user->poin = number_format($user->poin, 0, ',', '.');
        }
        return $users;
    }
};
?>

<div>
    <h1 class="font-bold mb-3">Hall of Fame 🔥</h1>
    <p class="mb-7">
        Kalau kamus ini hidup, mereka inilah yang berperan jadi jantungnya. Mereka nggak pake jubah, tapi mereka
        pahlawan
        buat
        kita semua. Yuk cek 100 pengguna teratas yang udah bikin kamus ini jadi lebih kaya makna.
    </p>
    <div class="space-y-2">
        @php
            $i = 1;
        @endphp
        @foreach ($this->users as $user)
            @php
                if ($i == 1) {
                    $style = 'gold';
                } elseif ($i == 2) {
                    $style = 'silver';
                } elseif ($i == 3) {
                    $style = 'bronze';
                } else {
                    $style = null;
                }
            @endphp
            <x-user-item username="{{ $user->username }}" level="{{ $user->level }}" point="{{ $user->poin }}"
                avatar="{{ $user->profile_pic }}" number="{{ $i }}" style="{{ $style }}" />
            @php
                $i++;
            @endphp
        @endforeach
    </div>
</div>
