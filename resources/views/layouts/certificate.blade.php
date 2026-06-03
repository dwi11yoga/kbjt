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
    {{ $slot }}
</body>

</html>
