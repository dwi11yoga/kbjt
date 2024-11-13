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

    {{-- Import font --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">

    {{-- Feathericon --}}
    <script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>
</head>

<body>
    {{-- Content --}}
    <div class="container p-10 mx-auto flex justify-center h-screen items-center">
        <div class="grid grid-cols-3 space-x-2">
            {{-- Gambar --}}
            <div
                class="md:col-span-2 col-span-3 overflow-hidden relative md:max-h-[35rem] max-h-32 md:rounded-2xl rounded-t-lg md:mt-0 mt-20">
                @yield('img')
            </div>
            <div class="md:col-span-1 col-span-3 md:p-5 p-0 pt-5">
                @yield('body')
            </div>
        </div>
    </div>


    {{-- Feathericon --}}
    <script>
        feather.replace();
    </script>
</body>

</html>
