<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $course->title }} - Kelas Online</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-slate-50 text-slate-900">

    <!-- Navbar -->
    <nav class="border-b border-slate-200 bg-white shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">
                <div class="flex items-center gap-2">
                    <div class="flex h-9 w-9 items-center justify-center rounded-xl bg-indigo-600 text-xs font-bold text-white shadow-sm">KO</div>
                    <span class="text-xl font-bold tracking-tight text-indigo-600">Kelas<span class="text-slate-900">Online</span></span>
                </div>
                <div class="flex items-center gap-4">
                    <a href="{{ route('landing.index') }}" class="font-medium text-slate-600 transition hover:text-indigo-600">Kembali ke Katalog</a>
                    @auth
                        <a href="{{ route('admin.dashboard') }}" class="font-medium text-slate-600 transition hover:text-indigo-600">Dashboard Admin</a>
                        <form method="POST" action="{{ route('logout') }}" class="inline">
                            @csrf
                            <button type="submit" class="font-medium text-slate-600 transition hover:text-rose-600">Logout</button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="font-medium text-slate-600 transition hover:text-indigo-600">Masuk</a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

        @if (session('success'))
            <div class="mb-6 rounded-lg border border-emerald-200 bg-emerald-50 px-4 py-3 text-emerald-800">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="mb-6 rounded-lg border border-rose-200 bg-rose-50 px-4 py-3 text-rose-800">
                <ul class="list-disc list-inside text-sm">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <!-- Detail Kursus -->
            <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
                @if ($course->image)
                    <img src="{{ \Illuminate\Support\Facades\Storage::url($course->image) }}" alt="{{ $course->title }}"
                         class="w-full h-64 object-cover">
                @else
                    <div class="flex h-64 w-full items-center justify-center bg-slate-100 text-sm text-slate-400">Tanpa Gambar</div>
                @endif

                <div class="p-6">
                    <div class="flex items-center gap-2 mb-2">
                        <span class="px-2 py-1 text-xs font-semibold rounded-full
                            @if($course->status->value === 'PUBLISHED') bg-emerald-50 text-emerald-700 ring-1 ring-inset ring-emerald-200 @else bg-amber-50 text-amber-700 ring-1 ring-inset ring-amber-200 @endif
                        ">
                            {{ ucfirst(strtolower($course->status->value)) }}
                        </span>
                        @if ($course->is_free)
                            <span class="rounded-full bg-indigo-50 px-2 py-1 text-xs font-semibold text-indigo-700 ring-1 ring-inset ring-indigo-200">Gratis</span>
                        @endif
                    </div>

                    <h1 class="mb-2 text-2xl font-bold text-slate-900">{{ $course->title }}</h1>
                    <p class="mb-4 text-slate-600"><strong>Kategori:</strong> {{ $course->category->name }}</p>
                    <p class="mb-4 text-slate-600"><strong>Instruktur:</strong> {{ $course->instructor }}</p>
                    <p class="mb-6 text-slate-600"><strong>Harga:</strong>
                        <span class="text-lg font-bold">{{ $course->is_free ? 'Gratis' : 'Rp ' . number_format($course->price, 0, ',', '.') }}</span>
                    </p>

                    <div class="mb-6">
                        <h3 class="mb-2 text-sm font-semibold uppercase tracking-wider text-slate-900">Deskripsi</h3>
                        <p class="leading-relaxed text-slate-600">{{ $course->description }}</p>
                    </div>

                    <a href="{{ route('landing.index') }}" class="inline-flex items-center text-sm font-medium text-indigo-600 hover:text-indigo-700">
                        <span class="mr-1">←</span> Kembali ke Katalog
                    </a>
                </div>
            </div>

            <!-- Form Pendaftaran -->
            <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
                <h2 class="mb-6 text-xl font-bold text-slate-900">Daftar Kelas</h2>

                <form method="POST" action="{{ route('landing.enroll', $course->id) }}">
                    @csrf

                    <div class="mb-4">
                        <label for="name" class="mb-1 block text-sm font-medium text-slate-700">Nama Lengkap</label>
                        <input type="text" name="name" id="name" value="{{ old('name') }}" required
                            class="w-full rounded-lg border border-slate-300 px-4 py-2 outline-none transition focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500">
                        @error('name')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="email" class="mb-1 block text-sm font-medium text-slate-700">Email</label>
                        <input type="email" name="email" id="email" value="{{ old('email') }}" required
                            class="w-full rounded-lg border border-slate-300 px-4 py-2 outline-none transition focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500">
                        <p class="mt-1 text-xs text-indigo-600"><strong>Penting:</strong> Masukkan email yang aktif. Konfirmasi pendaftaran akan dikirimkan ke email ini.</p>
                        @error('email')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-6">
                        <label for="phone" class="mb-1 block text-sm font-medium text-slate-700">Nomor HP</label>
                        <input type="text" name="phone" id="phone" value="{{ old('phone') }}"
                            placeholder="Contoh: 08123456789"
                            class="w-full rounded-lg border border-slate-300 px-4 py-2 outline-none transition focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500">
                        @error('phone')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <input type="hidden" name="course_id" value="{{ $course->id }}">

                    <button type="submit"
                        class="w-full rounded-lg bg-indigo-600 px-6 py-3 font-semibold text-white transition hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                        Daftar Sekarang
                    </button>
                </form>

                <div class="mt-6 border-t border-slate-200 pt-6 text-center text-sm text-slate-500">
                    Setelah daftar, status pendaftaran Anda akan menjadi <strong>PENDING</strong> dan menunggu verifikasi dari admin.
                </div>
            </div>
        </div>

    </div>

</body>
</html>
