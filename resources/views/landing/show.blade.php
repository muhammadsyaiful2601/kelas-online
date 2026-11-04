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
<body class="bg-gray-50 text-gray-900">

    <!-- Navbar -->
    <nav class="bg-white shadow-sm border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">
                <div class="flex items-center gap-2">
                    <span class="text-xl font-bold text-indigo-600">Kelas<span class="text-gray-800">Online</span></span>
                </div>
                <div class="flex items-center gap-4">
                    <a href="{{ route('landing.index') }}" class="text-gray-700 font-medium hover:text-indigo-600">Kembali ke Katalog</a>
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

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

        @if (session('success'))
            <div class="mb-6 bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-lg">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="mb-6 bg-red-50 border border-red-200 text-red-800 px-4 py-3 rounded-lg">
                <ul class="list-disc list-inside text-sm">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <!-- Detail Kursus -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                @if ($course->image)
                    <img src="{{ \Illuminate\Support\Facades\Storage::url($course->image) }}" alt="{{ $course->title }}"
                         class="w-full h-64 object-cover">
                @else
                    <div class="w-full h-64 bg-gray-100 flex items-center justify-center text-gray-400 text-sm">Tanpa Gambar</div>
                @endif

                <div class="p-6">
                    <div class="flex items-center gap-2 mb-2">
                        <span class="px-2 py-1 text-xs font-semibold rounded-full
                            @if($course->status->value === 'PUBLISHED') bg-green-100 text-green-800 @else bg-yellow-100 text-yellow-800 @endif
                        ">
                            {{ ucfirst(strtolower($course->status->value)) }}
                        </span>
                        @if ($course->is_free)
                            <span class="px-2 py-1 text-xs font-semibold bg-blue-100 text-blue-800 rounded-full">Gratis</span>
                        @endif
                    </div>

                    <h1 class="text-2xl font-bold text-gray-900 mb-2">{{ $course->title }}</h1>
                    <p class="text-gray-600 mb-4"><strong>Kategori:</strong> {{ $course->category->name }}</p>
                    <p class="text-gray-600 mb-4"><strong>Instruktur:</strong> {{ $course->instructor }}</p>
                    <p class="text-gray-600 mb-6"><strong>Harga:</strong>
                        <span class="text-lg font-bold">{{ $course->is_free ? 'Gratis' : 'Rp ' . number_format($course->price, 0, ',', '.') }}</span>
                    </p>

                    <div class="mb-6">
                        <h3 class="text-sm font-semibold text-gray-900 uppercase tracking-wider mb-2">Deskripsi</h3>
                        <p class="text-gray-600 leading-relaxed">{{ $course->description }}</p>
                    </div>

                    <a href="{{ route('landing.index') }}" class="text-sm text-indigo-600 hover:text-indigo-500 font-medium inline-flex items-center">
                        <span class="mr-1">←</span> Kembali ke Katalog
                    </a>
                </div>
            </div>

            <!-- Form Pendaftaran -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <h2 class="text-xl font-bold text-gray-900 mb-6">Daftar Kelas</h2>

                <form method="POST" action="{{ route('landing.enroll', $course->id) }}">
                    @csrf

                    <div class="mb-4">
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap</label>
                        <input type="text" name="name" id="name" value="{{ old('name') }}" required
                            class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition">
                        @error('name')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                        <input type="email" name="email" id="email" value="{{ old('email') }}" required
                            class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition">
                        <p class="mt-1 text-xs text-blue-600"><strong>Penting:</strong> Masukkan email yang aktif. Konfirmasi pendaftaran akan dikirimkan ke email ini.</p>
                        @error('email')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-6">
                        <label for="phone" class="block text-sm font-medium text-gray-700 mb-1">Nomor HP</label>
                        <input type="text" name="phone" id="phone" value="{{ old('phone') }}"
                            placeholder="Contoh: 08123456789"
                            class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition">
                        @error('phone')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <input type="hidden" name="course_id" value="{{ $course->id }}">

                    <button type="submit"
                        class="w-full px-6 py-3 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg font-medium transition">
                        Daftar Sekarang
                    </button>
                </form>

                <div class="mt-6 pt-6 border-t border-gray-200 text-sm text-gray-500 text-center">
                    Setelah daftar, status pendaftaran Anda akan menjadi <strong>PENDING</strong> dan menunggu verifikasi dari admin.
                </div>
            </div>
        </div>

    </div>

</body>
</html>
