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
<body class="bg-gray-50 text-gray-900">

    <!-- Navbar -->
    <nav class="bg-white shadow-sm border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">
                <div class="flex items-center gap-2">
                    <span class="text-xl font-bold text-indigo-600">Kelas<span class="text-gray-800">Online</span></span>
                </div>
                <div class="flex items-center gap-4">
                    <a href="{{ route('landing.index') }}" class="text-indigo-600 font-medium">Beranda</a>
                    @auth
                        <a href="{{ route('admin.dashboard') }}" class="text-gray-700 font-medium hover:text-indigo-600">Dashboard Admin</a>
                        <form method="POST" action="{{ route('logout') }}" class="inline">
                            @csrf
                            <button type="submit" class="text-gray-700 font-medium hover:text-red-600">Logout</button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="text-gray-700 font-medium hover:text-indigo-600">Masuk</a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <header class="bg-indigo-600 text-white py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="text-3xl font-bold mb-4">Kelas Online untuk Semua</h1>
            <p class="text-indigo-100 mb-6 max-w-2xl">
                Temukan berbagai kelas online terbaik dari instruktur terpercaya. Daftar sekarang dan mulailah belajar.
            </p>
        </div>
    </header>

    <!-- Search & Filter -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
        <form method="GET" action="{{ route('landing.index') }}" class="bg-white p-6 rounded-xl shadow-sm border border-gray-200 mb-8">
            <div class="flex flex-col sm:flex-row gap-4 items-end">
                <div class="flex-1">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Cari kelas</label>
                    <input type="text" name="search" value="{{ request('search') }}"
                        placeholder="Judul atau deskripsi kelas..."
                        class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition">
                </div>
                <div class="flex-1">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Kategori</label>
                    <select name="category_id" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition">
                        <option value="">Semua Kategori</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="px-6 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg font-medium transition">
                    Tampilkan
                </button>
            </div>
        </form>

        <!-- Kursus Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse ($courses as $course)
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden hover:shadow-md transition">
                    @if ($course->image)
                        <img src="{{ \Illuminate\Support\Facades\Storage::url($course->image) }}" alt="{{ $course->title }}"
                             class="w-full h-48 object-cover">
                    @else
                        <div class="w-full h-48 bg-gray-100 flex items-center justify-center text-gray-400 text-sm">Tanpa Gambar</div>
                    @endif

                    <div class="p-5">
                        <div class="flex justify-between items-start mb-2">
                            <span class="text-xs font-semibold bg-indigo-100 text-indigo-700 px-2 py-1 rounded uppercase tracking-wider">
                                {{ $course->category->name }}
                            </span>
                            <span class="text-xs font-semibold
                                @if($course->status->value === 'PUBLISHED') text-green-600 @else text-yellow-600 @endif
                            ">
                                {{ ucfirst(strtolower($course->status->value)) }}
                            </span>
                        </div>

                        <h3 class="text-lg font-bold text-gray-900 mb-1">{{ $course->title }}</h3>
                        <p class="text-gray-500 text-sm mb-3 line-clamp-2">{{ $course->description }}</p>

                        <div class="flex items-center justify-between mb-4">
                            <span class="text-lg font-bold text-gray-900">
                                {{ $course->is_free ? 'Gratis' : 'Rp ' . number_format($course->price, 0, ',', '.') }}
                            </span>
                            <span class="text-xs text-gray-500">{{ $course->instructor }}</span>
                        </div>

                        <a href="{{ route('landing.show', $course->slug) }}"
                           class="w-full px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white text-center rounded-lg text-sm font-medium transition block">
                            Lihat Detail & Daftar
                        </a>
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center py-10 text-gray-500">
                    Tidak ada kelas yang ditemukan.
                </div>
            @endforelse
        </div>

        {{ $courses->links() }}
    </div>

</body>
</html>
