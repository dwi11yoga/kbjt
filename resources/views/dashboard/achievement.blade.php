@extends('layouts.dashboard')

@section('body')
    {{-- Overview --}}
    <div class="">
        <div class="mb-3">Overview</div>
        <div class="grid grid-cols-3 gap-3 ">
            {{-- Kosakata --}}
            <div
                class="md:col-span-1 col-span-3 border bg-white border-neutral-200 rounded-xl px-4 py-5 hover:outline hover:outline-offset-2 hover:outline-amber-400 hover:decoration-1">
                <div>Achievement diperoleh<br>
                    <div class="flex items-baseline">
                        <h1 class="font-bold -mt-2">{{ $overview['achievement'] }}</h1>
                        <div class="">/{{ $overview['total'] }}</div>
                    </div>
                </div>
                <div class="text-sm">
                    {{ $overview['persentase'] }} achievement telah kamu dapatkan
                </div>
            </div>
        </div>
    </div>

    {{-- daftar achievement --}}
    <div class="space-y-3">
        <div class="flex justify-between items-center">
            <div class="flex items-center">Daftar achievement</div>

            <form action="" method="GET" class="relative">
                <i data-feather='filter' class="w-5 absolute top-2 left-3"></i>
                <select name="filter" id="filter" onchange="muatDropdown(this)"
                    class="appearance-none rounded-xl py-2 pl-10 pr-3 bg-white cursor-pointer md:max-w-none max-w-10">
                    <option value="">Filter</option>
                    <option {{ request()->filter == 'Didapatkan' ? 'selected' : '' }}>Didapatkan</option>
                    <option {{ request()->filter == 'Belum didapatkan' ? 'selected' : '' }}>Belum didapatkan</option>
                </select>
            </form>
        </div>

        <div class="space-y-2">
            @foreach ($achievement as $d)
                <div
                    class="px-5 py-6 bg-white rounded-2xl grid md:grid-cols-12 grid-cols-10 space-x-4 hover:outline hover:outline-amber-400">
                    <div class="md:col-span-1 col-span-3 flex items-center justify-center">
                        <img src="https://static.wikia.nocookie.net/pentiment/images/6/66/F3893dab65dfc92e0cbd0b7c1d052f0b28d7daf9.jpg"
                            class="w-full" alt="Icon">
                    </div>
                    <div class="md:col-span-11 col-span-7 flex items-center">
                        <div class="w-full space-y-2">
                            <div class="">
                                <div class="capitalize font-medium">{{ $d->achievement }}</div>
                                <div class="text-sm line-clamp-2">{{ $d->deskripsi }}</div>
                            </div>
                            <div class="relative">
                                <div class="absolute w-full bg-neutral-200 rounded-full py-1 "></div>
                                <div class="absolute bg-amber-400 w-[10%] rounded-full py-1"></div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="">
            {{ $achievement->links() }}
        </div>
    </div>
@endsection
