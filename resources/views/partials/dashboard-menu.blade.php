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
        <a href="/pengaturan"
            class="group w-14 h-14 flex justify-center items-center rounded-xl hover:bg-yellow-300 active:bg-yellow-400">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                class="feather feather-settings">
                <path fill="{{ $group == 'settings' ? 'currentColor' : '' }}"
                    class="{{ $group == 'settings' ? 'fill-yellow-300' : '' }}"
                    d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z">
                </path>
                <circle cx="12" cy="12" r="3" fill="{{ $group == 'settings' ? 'currentColor' : '' }}"
                    class="{{ $group == 'settings' ? 'fill-yellow-300' : '' }}"></circle>
            </svg>
            {{-- <i data-feather='tool' class="{{ $group == 'settings' ? 'fill-yellow-300' : '' }}"></i> --}}
            <div class="relative">
                <div
                    class="hidden absolute top-0.5 left-[1.4rem] transform -translate-y-1/2 bg-yellow-300 w-4 h-4 rotate-45 group-hover:block">
                </div>
                <div class="hidden absolute -top-6 left-6 p-3 rounded-xl group-hover:block bg-yellow-300">
                    Pengaturan</div>
            </div>
        </a>

        <hr class="h-px mx-auto w-3/5">

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
