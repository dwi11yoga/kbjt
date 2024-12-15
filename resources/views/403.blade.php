{{-- @extends('layouts.homepage')

@section('body')
    
@endsection --}}

<!DOCTYPE html>
<html lang="en">

<head>
    {{-- Meta --}}
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title }} | Kamus Besar Bahasa Jawa</title>

    {{-- Import CSS --}}
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    {{-- Import js --}}
    <script src="{{ asset('js/script.js') }}"></script>

    {{-- Import font --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">

    {{-- Feathericon --}}
    <script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>
</head>

<body>
    <div class="container mx-auto h-screen flex items-center justify-center">
        <div
            class="px-10 py-8 rounded-2xl flex justify-center items-center text-center flex-col shadow-sm border border-neutral-200 md:w-1/2 w-11/12">
            <img src="{{ asset('img/403.png') }}"
                alt="403 error forbidden (with police) concept illustration (Freepik/storyset)" class="mb-5"
                style="width: 25rem">
            <div class="font-semibold mb-1">Ups! Akses kamu ke halaman ini ditolak.</div>
            <div>Halaman ini hanya dapat diakses oleh pengguna tertentu. Pastikan kamu memiliki hak akses yang sesuai.
            </div>
            <a href="/"
                class="border rounded-xl mt-3 p-3 flex items-center hover:bg-neutral-800 hover:text-white">
                <i data-feather='chevron-left' class="w-5 mr-1"></i>
                Beranda
            </a>
        </div>
    </div>

    <script>
        feather.replace();
    </script>
</body>

</html>
