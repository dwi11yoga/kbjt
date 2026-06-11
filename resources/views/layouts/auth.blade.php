<!DOCTYPE html>
<html lang="en">

<head>
    {{-- Meta --}}
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>{{ isset($title) ? $title . ' - ' : '' }} {{ env('APP_NAME') }}</title>

    {{-- font --}}
    {{-- NOTO SANS & NOTO SANS JAVANESE --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Noto+Sans+Javanese:wght@400..700&family=Noto+Sans:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- load darkmode sebelum halaman dimuat --}}
    <script>
        if (localStorage.theme === 'dark' ||
            (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        }
    </script>

    @livewireStyles
</head>

<body>
    {{-- Content --}}
    <div class="container md:p-0 p-10 mx-auto flex flex-col justify-center h-screen items-center">
        <div class="space-y-2">
            <a href="{{ url()->previous() == url()->current() || request()->path() == 'masuk' ? '/' : url()->previous() }}"
                class="small-text items-center p-2 -ml-2 hover:ring-1 dark:ring-zinc-700 ring-gray-500 rounded-full active:bg-black active:text-white">
                <i data-lucide='arrow-left' class="w-4 inline-block"></i> kembali
            </a>
            {{ $slot ?? '' }}
            @yield('body')
        </div>
    </div>

    <x-toast type="dispatch" />
    <x-toast type="session" />

</body>

</html>
