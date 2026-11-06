<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? 'KelasOnline — Belajar tanpa batas' }}</title>
    <link rel="icon" type="image/jpg" href="{{ asset('images/logo.jpg') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="overflow-x-hidden bg-brand-background text-brand-text antialiased">
    <header x-data="{ open: false }" class="sticky top-0 z-50 border-b border-brand-border/80 bg-white/95 backdrop-blur">
        <nav class="mx-auto flex h-16 max-w-7xl items-center justify-between px-4 sm:px-6 lg:px-8" aria-label="Navigasi utama">
            <a href="{{ route('landing.index') }}" aria-label="KelasOnline beranda">
                <x-brand-logo />
            </a>
            <div class="hidden items-center gap-7 md:flex">
                <a href="{{ route('landing.index') }}" class="text-sm font-medium text-slate-600 transition hover:text-indigo-600">Beranda</a>
                <a href="{{ route('landing.index') }}#kelas" class="text-sm font-medium text-slate-600 transition hover:text-indigo-600">Kelas</a>
                <a href="{{ route('landing.index') }}#cara-kerja" class="text-sm font-medium text-slate-600 transition hover:text-indigo-600">Cara Kerja</a>
            </div>
            <div class="hidden items-center gap-3 md:flex">
                @auth
                    <span class="max-w-32 truncate text-sm font-medium text-slate-600">{{ auth()->user()->name }}</span>
                    <x-button href="{{ route('admin.dashboard') }}">Dashboard</x-button>
                @else
                    <x-button href="{{ route('login') }}" variant="secondary">Masuk</x-button>
                @endauth
            </div>
            <button @click="open = !open" :aria-expanded="open" aria-controls="mobile-menu" class="inline-flex h-10 w-10 items-center justify-center rounded-xl text-slate-600 hover:bg-slate-100 ui-focus md:hidden">
                <span class="sr-only">Buka menu</span>
                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
            </button>
        </nav>
        <div id="mobile-menu" x-show="open" x-cloak class="border-t border-brand-border bg-white px-4 py-4 md:hidden">
            <div class="mx-auto flex max-w-7xl flex-col gap-2">
                <a @click="open = false" href="{{ route('landing.index') }}" class="rounded-xl px-3 py-2 text-sm font-medium text-slate-700 hover:bg-indigo-50">Beranda</a>
                <a @click="open = false" href="{{ route('landing.index') }}#kelas" class="rounded-xl px-3 py-2 text-sm font-medium text-slate-700 hover:bg-indigo-50">Kelas</a>
                <a @click="open = false" href="{{ route('landing.index') }}#cara-kerja" class="rounded-xl px-3 py-2 text-sm font-medium text-slate-700 hover:bg-indigo-50">Cara Kerja</a>
                @auth
                    <a href="{{ route('admin.dashboard') }}" class="mt-2 rounded-xl bg-indigo-600 px-3 py-2 text-center text-sm font-semibold text-white">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="mt-2 rounded-xl border border-slate-300 px-3 py-2 text-center text-sm font-semibold">Masuk</a>
                @endauth
            </div>
        </div>
    </header>
    <main>
        {{ $slot }}
    </main>
    <footer class="border-t border-slate-800 bg-slate-950 text-slate-300">
        <div class="mx-auto grid max-w-7xl gap-8 px-4 py-12 sm:px-6 md:grid-cols-2 lg:px-8">
            <div>
                <x-brand-logo dark />
                <p class="mt-4 max-w-sm text-sm leading-6 text-slate-400">Platform belajar online yang membantu Anda mengembangkan keterampilan untuk langkah berikutnya.</p>
            </div>
            <div class="md:justify-self-end">
                <p class="text-sm font-semibold text-white">Navigasi</p>
                <div class="mt-4 flex flex-col gap-2 text-sm">
                    <a href="{{ route('landing.index') }}#kelas" class="hover:text-white">Kelas</a>
                    <a href="{{ route('landing.index') }}#cara-kerja" class="hover:text-white">Cara Kerja</a>
                    <a href="{{ route('login') }}" class="hover:text-white">Masuk</a>
                </div>
            </div>
        </div>
        <div class="border-t border-slate-800">
            <p class="mx-auto max-w-7xl px-4 py-5 text-xs text-slate-500 sm:px-6 lg:px-8">© {{ date('Y') }} KelasOnline. Semua hak dilindungi.</p>
        </div>
    </footer>
</body>
</html>
