@extends('.../layouts/homepage-with-banner')
@section('body')
    <h3 class="font-bold mb-3">Hall of Fame 🔥</h3>
    <p class="mb-7">
        Kalau kamus ini hidup, mereka inilah yang berperan jadi jantungnya. Mereka nggak pake jubah, tapi mereka pahlawan
        buat
        kita semua. Yuk cek 100 pengguna teratas yang udah bikin kamus ini jadi lebih kaya makna.
    </p>
    <div class="space-y-3">
        <?php $i = 1; ?>
        @foreach ($user as $d)
            @if ($i == 1)
                <a href="/u/{{ $d->username }}" id="user{{ $i }}"
                    class="grid grid-cols-12 w-full @if ($d->id == auth()->user()?->id) outline outline-blue-600 @endif bg-yellow-100 rounded-2xl py-2 hover:outline hover:outline-2 hover:outline-offset-4 hover:outline-yellow-300 active:bg-yellow-200">
                    <div class="md:col-span-1 col-span-2 text-center mt-3 font-bold">#{{ $i }}</div>
                    <div class="md:col-span-7 col-span-10 flex">
                        <div class="w-10 h-10 rounded-full overflow-hidden mr-3 mt-1">
                            @include('partials.profile-pic-general')
                        </div>
                        <div><span class="small-text text-gray-500">Username</span><br>{{ $d->username }}
                            <span class="py-0.5 px-2 rounded-full bg-yellow-300 small-text">Lv.{{ $d->level }}</span>
                        </div>
                    </div>
                    <div class="md:col-span-2 col-start-3 col-span-3"><span
                            class="small-text text-gray-500">Poin</span><br>{{ $d->poin }}
                    </div>
                    <div class="md:col-span-2 col-span-7"><span class="small-text text-gray-500">Bergabung
                            sejak</span><br>{{ $d->created_at->translatedFormat('d F Y') }}</div>
                </a>
            @elseif ($i == 2)
                <a href="/u/{{ $d->username }}"
                    class="grid grid-cols-12 w-full @if ($d->id == auth()->user()?->id) outline outline-blue-600 @endif bg-gray-100 rounded-2xl py-2 hover:outline hover:outline-2 hover:outline-offset-4 hover:outline-gray-300 active:bg-gray-200">
                    <div class="md:col-span-1 col-span-2 text-center mt-3 font-bold">#{{ $i }}</div>
                    <div class="md:col-span-7 col-span-10 flex">
                        <div class="w-10 h-10 rounded-full overflow-hidden mr-3 mt-1">
                            @include('partials.profile-pic-general')
                        </div>
                        <div><span class="small-text text-gray-500">Username</span><br>{{ $d->username }}
                            <span class="py-0.5 px-2 rounded-full bg-yellow-300 small-text">Lv.{{ $d->level }}</span>
                        </div>
                    </div>
                    <div class="md:col-span-2 col-start-3 col-span-3"><span
                            class="small-text text-gray-500">Poin</span><br>{{ $d->poin }}
                    </div>
                    <div class="md:col-span-2 col-span-7"><span class="small-text text-gray-500">Bergabung
                            sejak</span><br>{{ $d->created_at->translatedFormat('d F Y') }}</div>
                </a>
            @elseif ($i == 3)
                <a href="/u/{{ $d->username }}"
                    class="grid grid-cols-12 w-full @if ($d->id == auth()->user()?->id) outline outline-blue-600 @endif bg-amber-100 rounded-2xl py-2 hover:outline hover:outline-2 hover:outline-offset-4 hover:outline-amber-300 active:bg-amber-200">
                    <div class="md:col-span-1 col-span-2 text-center mt-3 font-bold">#{{ $i }}</div>
                    <div class="md:col-span-7 col-span-10 flex">
                        <div class="w-10 h-10 rounded-full overflow-hidden mr-3 mt-1">
                            @include('partials.profile-pic-general')
                        </div>
                        <div><span class="small-text text-gray-500">Username</span><br>{{ $d->username }}
                            <span class="py-0.5 px-2 rounded-full bg-yellow-300 small-text">Lv.{{ $d->level }}</span>
                        </div>
                    </div>
                    <div class="md:col-span-2 col-start-3 col-span-3"><span
                            class="small-text text-gray-500">Poin</span><br>{{ $d->poin }}
                    </div>
                    <div class="md:col-span-2 col-span-7"><span class="small-text text-gray-500">Bergabung
                            sejak</span><br>{{ $d->created_at->translatedFormat('d F Y') }}</div>
                </a>
            @else
                <a href="/u/{{ $d->username }}"
                    class="grid grid-cols-12 w-full @if ($d->id == auth()->user()?->id) outline outline-blue-600 @endif bg-gray-50 rounded-2xl py-2 hover:outline hover:outline-2 hover:outline-offset-4 hover:outline-gray-200 active:bg-gray-100">
                    <div class="md:col-span-1 col-span-2 text-center mt-3">#{{ $i }}</div>
                    <div class="md:col-span-7 col-span-10 flex">
                        <div class="w-10 h-10 rounded-full overflow-hidden mr-3 mt-1">
                            @include('partials.profile-pic-general')
                        </div>
                        <div><span class="small-text text-gray-500">Username</span><br>{{ $d->username }}
                            <span class="py-0.5 px-2 rounded-full bg-yellow-300 small-text">Lv.{{ $d->level }}</span>
                        </div>
                    </div>
                    <div class="md:col-span-2 col-start-3 col-span-3"><span
                            class="small-text text-gray-500">Poin</span><br>{{ $d->poin }}
                    </div>
                    <div class="md:col-span-2 col-span-7"><span class="small-text text-gray-500">Bergabung
                            sejak</span><br>{{ $d->created_at->translatedFormat('d F Y') }}</div>
                </a>
            @endif
            <?php $i += 1; ?>
        @endforeach

        <?php for ($i=4; $i < 101; $i++) { 
            ?>

        <?php
        } ?>
    </div>

    {{-- <table class="w-full table table-auto">
        <thead>
            <tr>
                <td>#</td>
                <td>Anggota</td>
                <td>Poin</td>
                <td>Bergabung sejak</td>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>1</td>
                <td class="flex">
                    <div class="w-10 h-10 rounded-full bg-yellow-400"></div>
                    <div>moeklisuwu <span class="rounded-full py-2 px-3 bg-gray-300">Lv.100</span></div>
                </td>
                <td>34.000</td>
                <td>21 Agustus</td>
            </tr>
        </tbody>
    </table> --}}
@endsection
