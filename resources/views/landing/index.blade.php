<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Katalog Kelas - Kelas Online</title>
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
                    <img src="{{ asset('images/logo.jpg') }}" alt="Kelas Online Logo" class="h-9 w-9 rounded-xl object-cover shadow-sm">
                    <span class="text-xl font-bold tracking-tight text-indigo-600">Kelas<span class="text-slate-900">Online</span></span>
                </div>
                <div class="flex items-center gap-4">
                    <a href="{{ route('landing.index') }}" class="font-medium text-indigo-600">Beranda</a>
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

    <!-- Hero Section -->
    <header class="bg-indigo-700 py-14 text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <p class="mb-3 text-sm font-semibold uppercase tracking-[.2em] text-indigo-200">Belajar tanpa batas</p>
            <h1 class="mb-4 text-3xl font-bold tracking-tight sm:text-4xl">Kelas Online untuk Semua</h1>
            <p class="mb-2 max-w-2xl text-indigo-100">
                Temukan berbagai kelas online terbaik dari instruktur terpercaya. Daftar sekarang dan mulailah belajar.
            </p>
        </div>
    </header>

    <!-- Search & Filter -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
        <form method="GET" action="{{ route('landing.index') }}" class="mb-8 rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
            <div class="flex flex-col sm:flex-row gap-4 items-end">
                <div class="flex-1">
                    <label class="mb-1 block text-sm font-medium text-slate-700">Cari kelas</label>
                    <input type="text" name="search" value="{{ request('search') }}"
                        placeholder="Judul atau deskripsi kelas..."
                        class="w-full rounded-lg border border-slate-300 px-4 py-2 text-sm outline-none transition focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500">
                </div>
                <div class="flex-1">
                    <label class="mb-1 block text-sm font-medium text-slate-700">Kategori</label>
                    <select name="category_id" class="w-full rounded-lg border border-slate-300 px-4 py-2 text-sm outline-none transition focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500">
                        <option value="">Semua Kategori</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="rounded-lg bg-indigo-600 px-6 py-2 font-semibold text-white transition hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                    Tampilkan
                </button>
            </div>
        </form>

        <!-- Kursus Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse ($courses as $course)
                <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm transition hover:-translate-y-0.5 hover:shadow-md">
                    @if ($course->image)
                        <img src="{{ \Illuminate\Support\Facades\Storage::url($course->image) }}" alt="{{ $course->title }}"
                             class="w-full h-48 object-cover">
                    @else
                        <div class="flex h-48 w-full items-center justify-center bg-slate-100 text-sm text-slate-400">Tanpa Gambar</div>
                    @endif

                    <div class="p-5">
                        <div class="flex justify-between items-start mb-2">
                            <span class="rounded bg-indigo-50 px-2 py-1 text-xs font-semibold uppercase tracking-wider text-indigo-700">
                                {{ $course->category->name }}
                            </span>
                            <span class="text-xs font-semibold
                                @if($course->status->value === 'PUBLISHED') text-emerald-600 @else text-amber-600 @endif
                            ">
                                {{ ucfirst(strtolower($course->status->value)) }}
                            </span>
                        </div>

                        <h3 class="mb-1 text-lg font-bold text-slate-900">{{ $course->title }}</h3>
                        <p class="mb-3 line-clamp-2 text-sm text-slate-500">{{ $course->description }}</p>

                        <div class="flex items-center justify-between mb-4">
                            <span class="text-lg font-bold text-slate-900">
                                {{ $course->is_free ? 'Gratis' : 'Rp ' . number_format($course->price, 0, ',', '.') }}
                            </span>
                            <span class="text-xs text-slate-500">{{ $course->instructor }}</span>
                        </div>

                        <a href="{{ route('landing.show', $course->slug) }}"
                           class="block w-full rounded-lg bg-indigo-600 px-4 py-2 text-center text-sm font-semibold text-white transition hover:bg-indigo-700">
                            Lihat Detail & Daftar
                        </a>
                    </div>
                </div>
            @empty
                <div class="col-span-full py-10 text-center text-slate-500">
                    Tidak ada kelas yang ditemukan.
                </div>
            @endforelse
        </div>

        {{ $courses->links() }}
    </div>

</body>
</html>
