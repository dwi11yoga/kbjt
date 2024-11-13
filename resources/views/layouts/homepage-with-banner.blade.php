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
    {{-- Navbar --}}
    @include('.../partials/navbar')

    {{-- Konten --}}
    <div class="container mx-auto p-10">
        <div class="grid grid-cols-4 space-x-5 space-y-10">
            <div class="md:col-span-3 col-span-4">
                @yield('body')
            </div>
            {{-- Banner --}}
            <div class="md:col-span-1 col-span-4">
                <hr class="sm:hidden mb-10 w-1/3 border-2 align-middle mx-auto ">
                <div class="sticky top-24 space-y-3">
                    {{-- banner 1 --}}
                    <div class="rounded-2xl bg-gray-200 w-full h-60"></div>
                    {{-- banner 2 --}}
                    <div class="rounded-2xl bg-gray-200 w-full h-96"></div>
                </div>
            </div>
        </div>
    </div>

    {{-- footer --}}
    @include('.../partials/footer')

    {{-- Feathericon --}}
    <script>
        feather.replace();
    </script>
</body>

</html>
