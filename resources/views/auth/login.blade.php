<x-guest-layout>
    <div class="mb-8">
        <p class="mb-3 text-sm font-semibold uppercase tracking-wider text-indigo-600">Selamat datang kembali</p>
        <h2 class="text-3xl font-bold tracking-tight text-slate-900">Akses Akun Anda</h2>
        <p class="mt-2 text-sm leading-relaxed text-slate-500">Masukkan email dan password untuk mengakses akun Anda.</p>
    </div>

    <div class="mb-6">
        <a href="{{ route('landing.index') }}" class="inline-flex items-center gap-1.5 text-sm font-medium text-indigo-600 hover:text-indigo-700 transition">
            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            Kembali ke Beranda
        </a>
    </div>

    <x-auth-session-status class="mb-5 rounded-lg bg-emerald-50 px-4 py-3 text-sm text-emerald-700" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div class="mb-5">
            <label for="email" class="mb-2 block text-sm font-medium text-slate-700">Alamat email</label>
            <input
                id="email"
                type="email"
                name="email"
                placeholder="nama@email.com"
                class="block w-full rounded-lg border border-slate-300 bg-white px-4 py-3 text-sm text-slate-900 outline-none transition focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500"
                value="{{ old('email') }}"
                required
                autofocus
                autocomplete="username"
            />
            <x-input-error :messages="$errors->get('email')" class="mt-2 text-sm text-rose-600" />
        </div>

        <div class="relative mb-5">
            <label for="password" class="mb-2 block text-sm font-medium text-slate-700">Password</label>
            <input
                id="password"
                type="password"
                name="password"
                placeholder="Masukkan password"
                class="block w-full rounded-lg border border-slate-300 bg-white px-4 py-3 pr-12 text-sm text-slate-900 outline-none transition focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500"
                required
                autocomplete="current-password"
            />
            <button type="button" id="toggle-password" aria-label="Tampilkan password" class="absolute right-3 top-[2.4rem] text-slate-400 transition hover:text-indigo-600 focus:outline-none">
                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.482 7.745 7.764 5 12 5s8.518 2.745 9.542 7C20.518 16.255 16.236 19 12 19s-8.518-2.745-9.542-7z"></path>
                </svg>
            </button>
            <x-input-error :messages="$errors->get('password')" class="mt-2 text-sm text-rose-600" />
        </div>

        <div class="mb-7 flex items-center justify-between">
            <div class="flex items-center">
                <input id="remember_me" type="checkbox" name="remember" class="h-4 w-4 rounded border-slate-300 text-indigo-600 focus:ring-indigo-500">
                <label for="remember_me" class="ml-2 text-sm text-slate-600">Ingat saya</label>
            </div>

            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}" class="text-sm font-medium text-indigo-600 hover:text-indigo-700">Lupa password?</a>
            @endif
        </div>

        <button type="submit" class="flex w-full items-center justify-center rounded-lg bg-indigo-600 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
            Masuk ke akun
        </button>
    </form>

    <p class="mt-8 text-center text-xs text-slate-400">Akses aman untuk pengguna terdaftar.</p>
</x-guest-layout>

<script>
    // Password eye toggle
    document.getElementById('toggle-password').addEventListener('click', function () {
        const passwordInput = document.getElementById('password');
        const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordInput.setAttribute('type', type);
    });
</script>
