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
    <body class="font-sans text-gray-900 antialiased min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 relative overflow-hidden">
        <!-- Dark blue geometric background on right (desktop) -->
        <div class="hidden lg:block absolute top-0 right-0 w-2/3 h-full bg-[#0f172a] login-bg-pattern"></div>
        
        <div class="relative z-10 w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-2xl overflow-hidden sm:rounded-2xl">
            {{ $slot }}
        </div>
    </body>
</html>
