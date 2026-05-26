{{-- Layout untuk bantuan terhadap akun user --}}
{{-- misal: lupa kata sandi & verifikasi email --}}

<!DOCTYPE html>
<html lang="id">

<head>
    {{-- Meta --}}
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title }} | Kamus Besar Bahasa Jawa</title>

    {{-- favicon --}}
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">

    {{-- Import CSS --}}
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    {{-- Feathericon --}}
    <script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>
</head>

<body>
    {{-- Content --}}
    <div class="container p-10 mx-auto flex flex-col justify-center h-screen items-center space-y-5">
        {{-- logo --}}
        <div class="">
            <a href="/">
                <h4 class="font-bold underline decoration-amber-400 underline-offset-4 decoration-4">kbjt</h4>
            </a>
        </div>

        {{-- konten --}}
        <div class="p-6 rounded-2xl space-y-2 border border-neutral-200 md:w-1/3 w-11/12 shadow-sm">
            <h5 class="font-semibold mb-2">{{ $title }}</h5>
            @yield('body')
        </div>

        {{-- footer --}}
        <div class="text-sm">Copyright © {{ date('Y') }} Kamus Besar Bahasa Indonesia</div>
    </div>
    
    {{-- toast --}}
    @include('partials.toast')


    {{-- Feathericon --}}
    <script>
        feather.replace();
    </script>
</body>

</html>
