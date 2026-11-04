<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            .login-bg-pattern {
                background-image:
                    radial-gradient(circle at 0% 0%, #3b82f6 0%, transparent 20%),
                    radial-gradient(circle at 100% 0%, #3b82f6 0%, transparent 20%),
                    radial-gradient(circle at 0% 100%, #3b82f6 0%, transparent 20%),
                    radial-gradient(circle at 100% 100%, #3b82f6 0%, transparent 20%);
                background-size: 100px 100px;
                background-position: 0 0, 0 50px, 50px 0, 50px 50px;
                background-repeat: repeat;
            }
        </style>
    </head>
    <body class="font-sans text-gray-900 antialiased min-h-screen flex flex-col relative overflow-hidden">
        <!-- Left decorative section (desktop only) -->
        <div class="hidden lg:flex lg:w-1/2 h-screen bg-[#0f172a] login-bg-pattern flex-col justify-center items-center p-8 text-center">
            <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-blue-500 text-white mb-6 shadow-lg">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14M5 12a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v14a2 2 0 01-2-2m-2-4h.01M17 16a4 4 0 01-8 0 4 4 0 018 0z"></path>
                </svg>
            </div>
            <h1 class="text-4xl font-bold text-white mb-4">Selamat Datang di Kelas Online</h1>
            <p class="text-blue-100 text-lg max-w-md leading-relaxed">
                Tempat terbaik untuk mempelajari berbagai keterampilan baru dengan instruktur terbaik.
                Mulai perjalanan pembelajaran Anda hari ini.
            </p>
        </div>

        <!-- Right login form section -->
        <div class="flex-1 flex items-center justify-center p-6 sm:p-12 bg-white">
            <div class="w-full max-w-md">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>
