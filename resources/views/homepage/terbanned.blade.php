@extends('layouts.homepage')

@section('body')
    <div class="container mx-auto p-10 flex justify-center">
        <div class="p-12 rounded-2xl border border-neutral-200">
            <div class="grid grid-cols-3 md:space-x-3 md:space-y-0 space-y-3 items-center">

                <div class="md:order-1 order-2 md:col-span-1 col-span-3 flex justify-center">
                    <img src="{{ asset('img/Apologize-by-storyset.png') }}" class="w-72" alt="">
                </div>

                <div class="md:order-2 order-1 md:col-span-2 col-span-3 space-y-3">
                    <h4 class="font-semibold">{{ $title }}</h4>
                    <div>
                        Mohon maaf, akun kamu saat ini diblokir karena terdeteksi adanya aktivitas yang tidak sesuai dengan
                        kebijakan kami. Jika kamu merasa ini adalah kekeliruan, silakan hubungi kami untuk klarifikasi lebih
                        lanjut.
                    </div>
                    <div>— Terima kasih.</div>
                </div>

            </div>
        </div>
    </div>
@endsection
