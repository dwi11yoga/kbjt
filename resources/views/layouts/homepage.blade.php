<!DOCTYPE html>
<html lang="en">

<head>
    {{-- Meta --}}
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title }}</title>

    {{-- favicon --}}
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">

    {{-- Import CSS --}}
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    {{-- Import js --}}
    <script src="{{ asset('js/script.js') }}"></script>

    {{-- Feathericon --}}
    <script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>
</head>

<body>
    {{-- Navbar --}}
    @include('.../partials/navbar')

    {{-- Content --}}
    @yield('body')

    {{-- footer --}}
    @include('.../partials/footer')

    {{-- Feathericon --}}
    <script>
        feather.replace();
    </script>
</body>

</html>
