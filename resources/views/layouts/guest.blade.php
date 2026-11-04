<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Kelas Online') }}</title>

        <!-- Favicon -->
        <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
        <link rel="icon" type="image/jpg" href="{{ asset('images/logo.jpg') }}">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            .login-bg-pattern {
                background-image:
                    radial-gradient(circle at 15% 15%, rgba(99, 102, 241, .35) 0, transparent 24%),
                    radial-gradient(circle at 85% 85%, rgba(14, 165, 233, .2) 0, transparent 26%),
                    linear-gradient(135deg, #111827 0%, #1e1b4b 52%, #312e81 100%);
            }
        </style>
    </head>
    <body class="font-sans text-slate-900 antialiased">
        <main class="flex min-h-screen flex-col lg:flex-row">
            <!-- Brand section -->
            <section class="login-bg-pattern relative flex min-h-[280px] w-full flex-col justify-between overflow-hidden px-8 py-8 text-white sm:px-12 lg:min-h-screen lg:w-1/2 lg:px-16 lg:py-12">
                <div class="absolute -right-20 -top-20 h-64 w-64 rounded-full border border-white/10"></div>
                <div class="absolute -bottom-28 -left-20 h-80 w-80 rounded-full border border-white/10"></div>

                <div class="relative flex items-center gap-3">
                    <img src="{{ asset('images/logo.jpg') }}" alt="Kelas Online Logo" class="h-10 w-10 rounded-xl object-cover shadow-lg">
                    <span class="text-xl font-bold tracking-tight">Kelas<span class="text-indigo-300">Online</span></span>
                </div>

                <div class="relative max-w-lg py-10 lg:py-0">
                    <p class="mb-4 text-sm font-semibold uppercase tracking-[.25em] text-indigo-200">Belajar tanpa batas</p>
                    <h1 class="text-3xl font-bold leading-tight sm:text-4xl lg:text-5xl">Kembangkan kemampuan, raih peluang baru.</h1>
                    <p class="mt-5 max-w-md text-base leading-relaxed text-indigo-100/80 sm:text-lg">
                        Akses kelas pilihan dan lanjutkan perjalanan belajar Anda bersama KelasOnline.
                    </p>
                    <div class="mt-8 hidden items-center gap-3 text-sm text-indigo-100/80 sm:flex">
                        <span class="flex h-8 w-8 items-center justify-center rounded-full bg-white/10">✓</span>
                        Materi terarah untuk tujuan Anda
                    </div>
                </div>

                <p class="relative hidden text-xs text-indigo-200/70 lg:block">© {{ date('Y') }} KelasOnline. Semua hak dilindungi.</p>
            </section>

            <!-- Login form section -->
            <section class="flex w-full flex-1 items-center justify-center bg-slate-50 px-6 py-10 sm:px-12 lg:w-1/2 lg:px-20">
                <div class="w-full max-w-md">
                    {{ $slot }}
                </div>
            </section>
        </main>
    </body>
</html>
