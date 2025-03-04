<!DOCTYPE html>
<html lang="en">

<head>
    {{-- Meta --}}
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title }}</title>

    {{-- Import CSS --}}
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    {{-- Import js --}}
    <script src="{{ asset('js/script.js') }}"></script>

    {{-- Feathericon --}}
    <script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>

    {{-- atur tampilan print --}}
    <style>
        @media print {
            @page {
                size: A4 landscape;
                /* Bisa diganti: A3, A5, letter, legal */
                margin: 0;
                /* Mengatur margin */
            }

            body {
                transform: scale(1);
                /* Skala default */
            }
        }
    </style>

    {{-- langsung cetak ketika halaman dimuat --}}
    <script>
        window.onload = function() {
            window.print();
        }
    </script>
</head>

<body class="flex justify-center">

    {{-- sertifikat --}}
    <div class="relative p-20 border overflow-hidden" style="width: 297mm; height: 210mm; background-color: #FDFDFD;">

        <div class="grid grid-rows-3 h-full">
            {{-- bag atas --}}
            <div class="grid grid-cols-10">
                <div class="col-span-9 space-y-0.5">
                    <h4 class="font-bold underline decoration-amber-400 underline-offset-4 decoration-4">kbjt</h4>
                    <div class="text-xl">Kamus Bahasa Jawa Terbuka</div>
                    <div class="jawa text-xl">ꦥꦼꦥꦏ꧀ꦧꦱꦗꦮꦏꦧꦶꦏꦏ꧀</div>
                </div>

                <div class="col-span-1">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/d/d0/QR_code_for_mobile_English_Wikipedia.svg"
                        alt="QR Code" class="w-28">
                </div>
            </div>

            {{-- bag tengah --}}
            <div class="flex items-center">
                <div class="space-y-1" style="max-width: 55%">
                    <div class="text-5xl font-bold text-amber-700">Sertifikat</div>
                    <div class="text-2xl capitalize">{{ $sertifikat->nama }}</div>
                    <div class="jawa text-xl">ꦱꦺꦂꦠꦶꦥ꦳ꦶꦏꦠ꧀ꦥꦏꦸꦂꦩꦠꦤ꧀</div>
                </div>
            </div>

            {{-- bag bawah --}}
            <div class="grid grid-cols-2">
                <div class="flex items-end">
                    <div class="max-w-[75%]">
                        <div class="jawa text-lg">ꦏꦥꦫꦶꦔꦏꦼꦤ꧀ꦝꦠꦼꦁ</div>
                        <div class="text-xl -mt-1">Diberikan kepada</div>
                        <div class="text-3xl font-bold">{{ $user->nama }}</div>
                        <div>ID:{{ $user->idZerofill }}</div>
                        <div class="mt-2">Valid sejak {{ $sertifikat->didapat }}</div>
                    </div>
                </div>

                <div class="flex items-end justify-center">
                    <div>
                        <div><img src="https://upload.wikimedia.org/wikipedia/id/b/b7/Tanda_Tangan_Sjachroedin_ZP.png"
                                alt="tanda tangan" class="w-40"></div>
                        <div class="font-medium text-xl">{{ $kepala->nama }}</div>
                        <div class="">Ketua KBJT</div>
                    </div>
                </div>
            </div>
        </div>
        <img src="{{ asset('img/yellow-flower.png') }}"
            class="absolute top-64 left-[28rem] h-[40rem] rotate-[33deg] opacity-60">

    </div>


    {{-- Feathericon --}}
    <script>
        feather.replace();
    </script>
</body>

</html>
