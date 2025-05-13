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
                    <p>
                        Mohon maaf, akun kamu saat ini tidak lagi tersedia — ini bisa disebabkan karena adanya pemblokiran
                        akibat aktivitas yang melanggar kebijakan, atau karena kamu sendiri telah memilih untuk
                        menghapusnya.
                    </p>
                    <p>
                        Jika kamu merasa ini terjadi tanpa sepengetahuanmu dan membutuhkan bantuan, jangan ragu untuk
                        menghubungi kami melalui email atau media sosial.
                    </p>
                    <div>— Terima kasih.</div>
                </div>

            </div>
        </div>
    </div>
@endsection
