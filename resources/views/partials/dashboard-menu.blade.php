{{-- Menu --}}
<div class="col-span-1 col-start-2 items-start justify-end z-50 md:flex hidden">
    <div class="border border-gray-200 rounded-xl w-14 shadow-sm space-y-1 sticky top-10">
        {{-- Dashboard --}}
        <a href="/dashboard"
            class="group w-14 h-14 flex justify-center items-center rounded-xl hover:bg-yellow-300 active:bg-yellow-400">
            <i data-feather='home' class="{{ $group == 'dashboard' ? 'fill-yellow-300' : '' }}"></i>
            <div class="relative">
                <div
                    class="hidden absolute top-0.5 left-[1.4rem] transform -translate-y-1/2 bg-yellow-300 w-4 h-4 rotate-45 group-hover:block">
                </div>
                <div class="hidden absolute -top-6 left-6 p-3 rounded-xl group-hover:block bg-yellow-300">
                    Dashboard</div>
            </div>
        </a>

        {{-- Kontribusi --}}
        <a href="#"
            class="group w-14 h-14 flex justify-center items-center rounded-xl hover:bg-yellow-300 active:bg-yellow-400">
            <i data-feather='edit-2' class="{{ $group == 'kontribusi' ? 'fill-yellow-300' : '' }}"></i>
            <div class="relative">
                <div
                    class="hidden absolute top-0.5 left-[1.4rem] transform -translate-y-1/2 bg-yellow-300 w-4 h-4 rotate-45 group-hover:block">
                </div>
                <div class="hidden absolute -top-6 left-6 p-3 rounded-xl group-hover:block bg-yellow-300">
                    Kontribusi</div>
            </div>
        </a>

        {{-- Leaderboard --}}
        <a href="#"
            class="group w-14 h-14 flex justify-center items-center rounded-xl hover:bg-yellow-300 active:bg-yellow-400">
            <i data-feather='award' class="{{ $group == 'leaderboard' ? 'fill-yellow-300' : '' }}"></i>
            <div class="relative">
                <div
                    class="hidden absolute top-0.5 left-[1.4rem] transform -translate-y-1/2 bg-yellow-300 w-4 h-4 rotate-45 group-hover:block">
                </div>
                <div class="hidden absolute -top-6 left-6 p-3 rounded-xl group-hover:block bg-yellow-300">
                    Leaderboard</div>
            </div>
        </a>

        {{-- Pengaturan --}}
        <a href="#"
            class="group w-14 h-14 flex justify-center items-center rounded-xl hover:bg-yellow-300 active:bg-yellow-400">
            <i data-feather='settings' class="{{ $group == 'settings' ? 'fill-yellow-300' : '' }}"></i>
            <div class="relative">
                <div
                    class="hidden absolute top-0.5 left-[1.4rem] transform -translate-y-1/2 bg-yellow-300 w-4 h-4 rotate-45 group-hover:block">
                </div>
                <div class="hidden absolute -top-6 left-6 p-3 rounded-xl group-hover:block bg-yellow-300">
                    Pengaturan</div>
            </div>
        </a>

        <hr class="h-px mx-auto w-3/5">

        {{-- Logout sementara --}}
        <form action="/logout" method="POST">
            @csrf
            <button type="submit" href="/logout"
                class="group w-14 h-14 flex justify-center items-center rounded-xl hover:bg-yellow-300 active:bg-yellow-400 cursor-pointer">
                <i data-feather='log-out'></i>
                <div class="relative">
                    <div
                        class="hidden absolute top-0.5 left-[1.4rem] transform -translate-y-1/2 bg-yellow-300 w-4 h-4 rotate-45 group-hover:block">
                    </div>
                    <div class="hidden absolute -top-6 left-6 p-3 rounded-xl group-hover:block bg-yellow-300">
                        Logout</div>
                </div>
            </button>
        </form>

        {{-- Ke Beranda --}}
        <a href="/"
            class="group w-14 h-14 flex justify-center items-center rounded-xl hover:bg-yellow-300 active:bg-yellow-400">
            <i data-feather='arrow-left'></i>
            <div class="relative">
                <div
                    class="hidden absolute top-0.5 left-[1.4rem] transform -translate-y-1/2 bg-yellow-300 w-4 h-4 rotate-45 group-hover:block">
                </div>
                <div class="hidden absolute -top-6 left-6 p-3 rounded-xl group-hover:block bg-yellow-300">
                    Beranda</div>
            </div>
        </a>
    </div>
</div>
