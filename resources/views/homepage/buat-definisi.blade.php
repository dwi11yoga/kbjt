@extends('layouts.homepage-with-banner')

@section('body')
    <h3 class="font-semibold">Buat definisi</h3>
    <form action="#">
        <div class="md:col-start-2 md:col-span-3 col-span-6">
            <div
                class="bg-white rounded-2xl p-6 mb-4 border border-neutral-200 hover:outline hover:outline-2 hover:outline-amber-400">
                {{-- Kosakata --}}
                <h5 class="font-semibold mb-4">Madang</h5>

                {{-- Definisi --}}
                <p class="mb-3">Lorem ipsum dolor sit amet consectetur adipisicing elit. Eos, consequuntur?</p>

                {{-- Contoh kalimat --}}
                <p>Contoh kalimat:</p>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ipsam, nobis.</p>

                {{-- Referensi --}}
                <div class="italic font-light small-text mt-4">
                    <p>Referensi</p>
                    <ul class="list-decimal list-inside">
                        <li>
                            <a href="#" target="_blank"
                                class="hover:underline hover:decoration-amber-400 hover:underline-offset-2 hover:decoration-2">Lorem,
                                ipsum dolor.</a>
                        </li>
                        {{-- {{ $d->referensi }} --}}
                        {{-- <li>Kitab Pranata Adicara (Purwadi, 2020)</li>
                        <li>https://www.cnnindoensia.com/bahasa-krama</li>
                        <li>https://brainly.co.id/tugas/17480360</li> --}}
                    </ul>
                </div>

                {{-- Author --}}
                <p class="mt-4 mb-2">Disubmit oleh</p>
                {{-- <div class="rounded-full w-12 h-12 bg-yellow-400 float-left mr-3"></div> --}}
                <div class="flex justify-between items-end">
                    <div class="flex items-center">
                        <a href="#">
                            <div class="h-12 w-12 rounded-full overflow-hidden mr-3">
                                @isset(auth()->user()->profile_pic)
                                    <img class="w-full h-full object-cover"
                                        src="{{ asset('storage/' . auth()->user()->profile_pic) }}" alt="Profile picture">
                                @else
                                    @if (isset(auth()->user()->jenis_kelamin) && auth()->user()->jenis_kelamin == 'Perempuan')
                                        <img class="w-full h-full object-cover"
                                            src="{{ asset('storage/profile-pics/profile_pic-f.jpg') }}"
                                            alt="Profile picture (Freepik/gstudioimagen)">
                                    @else
                                        <img class="w-full h-full object-cover"
                                            src="{{ asset('storage/profile-pics/profile_pic-m.jpg') }}"
                                            alt="Profile picture (Freepik/gstudioimagen)">
                                    @endif
                                @endisset
                            </div>
                        </a>
                        <a href="#">
                            <div>{{ auth()->user()->nama }}</div>
                            <div class="small-text">{{ now()->format('d F Y') }}</div>
                        </a>
                    </div>
                    <div><i data-feather='more-vertical'></i></div>
                </div>
            </div>
        </div>
    </form>
@endsection
