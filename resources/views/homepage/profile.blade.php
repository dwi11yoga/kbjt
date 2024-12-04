@extends('layouts.homepage')

@section('body')
    {{-- Header profil --}}
    <section class="px-28 py-14 mx-auto bg-neutral-100">
        <div class="container mx-auto">
            <div class="flex space-x-20">

                <div class="relative">
                    {{-- Foto profil --}}
                    <div
                        class="overflow-hidden h-64 w-64 ml-2 rounded-full flex justify-center hover:outline hover:outline-amber-400 hover:outline-offset-4 hover:outline-4">
                        <?php $d = $user; ?>
                        @include('partials.profile-pic-general')
                    </div>
                    <div
                        class="absolute top-3 -right-4 bg-amber-400 border-4 border-neutral-100 rounded-full py-2 px-4 font-semibold text-lg">
                        Lv.{{ $user->level }}
                    </div>
                </div>

                <div class="col-span-2 flex items-center">
                    <div class="space-y-2">

                        {{-- Nama & username --}}
                        <div>
                            <h3 class="font-bold">{{ $user->nama }}</h3>
                            <div>&#64;{{ $user->username }}
                                @isset($user->kota)
                                    • {{ $user->kota }}
                                @endisset
                            </div>
                        </div>

                        {{-- Bio --}}
                        <div>
                            {{-- <h5>Bio</h5> --}}
                            <p class="line-clamp-3">
                                @isset($user->bio)
                                    {{ $user->bio }}
                                @else
                                    Bio belum ditambahkan.
                                @endisset
                            </p>
                        </div>

                        {{-- Bergabung --}}
                        <div class="text-neutral-600">
                            Bergabung sejak {{ $user->created_at->format('d F Y') }}.
                        </div>

                        {{-- Website & Media sosial --}}
                        <div>
                            <div class="inline-flex items-center -ml-2 mt-1">
                                {{-- Website --}}
                                @include('partials.profil-medsos')

                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Kontribusi dan detail user --}}
    <section class="px-28 my-2">
        <div class="container mx-auto">

            {{-- Tab --}}
            <div class="flex space-x-4 bg-white py-3">
                <a id="definisi" href="#lalala" onclick="tabFokus(this)"
                    class="py-2 px-4 rounded-full border border-neutral-200 hover:outline hover:outline-amber-400 active:bg-amber-400">
                    Definisi</a>
                <a id="definisi" href="#lalala" onclick="tabFokus(this)"
                    class="py-2 px-4 rounded-full border border-neutral-200 hover:outline hover:outline-amber-400 active:bg-amber-400">
                    Kosakata</a>
                <a id="definisi" href="#lalala" onclick="tabFokus(this)"
                    class="py-2 px-4 rounded-full border border-neutral-200 hover:outline hover:outline-amber-400 active:bg-amber-400">
                    Achivement</a>
                <a id="definisi" href="#lalala" onclick="tabFokus(this)"
                    class="py-2 px-4 rounded-full border border-neutral-200 hover:outline hover:outline-amber-400 active:bg-amber-400">
                    Tentang
                </a>

                <script>
                    function tabFokus(self) {
                        self.classList.add('bg-');
                    }
                </script>
            </div>

            {{-- Isi --}}
            <div class="grid grid-cols-4 space-x-7 mt-2">
                {{-- konten --}}
                <div class="col-span-3 text-justify">
                    @foreach ($definisi as $d)
                        @include('partials.definisi')
                    @endforeach
                </div>
                {{-- banner --}}
                <div class="col-span-1">
                    <div class="sticky top-24 space-y-3">
                        @include('partials.sidebar-banner')
                    </div>
                </div>
            </div>

        </div>
    </section>
@endsection
