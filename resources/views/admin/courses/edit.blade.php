@extends('layouts.admin')

@section('title', 'Edit Kelas')

@section('content')
    <div class="max-w-3xl mx-auto">
        <h1 class="text-2xl font-bold text-gray-900 mb-6">Edit Kelas</h1>

        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <form method="POST" action="{{ route('admin.courses.update', $course) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <div class="mb-4">
                        <label for="category_id" class="block text-sm font-medium text-gray-700 mb-1">Kategori</label>
                        <select name="category_id" id="category_id" required
                            class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition">
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id', $course->category_id) == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                        <select name="status" id="status" required
                            class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition">
                            <option value="DRAFT" {{ old('status', $course->status->value) === 'DRAFT' ? 'selected' : '' }}>Draft</option>
                            <option value="PUBLISHED" {{ old('status', $course->status->value) === 'PUBLISHED' ? 'selected' : '' }}>Published</option>
                        </select>
                    </div>
                </div>

                <div class="mb-4">
                    <label for="title" class="block text-sm font-medium text-gray-700 mb-1">Judul Kelas</label>
                    <input type="text" name="title" id="title" value="{{ old('title', $course->title) }}" required
                        class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition">
                    @error('title')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="slug" class="block text-sm font-medium text-gray-700 mb-1">Slug</label>
                    <input type="text" name="slug" id="slug" value="{{ old('slug', $course->slug) }}" required
                        class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition">
                    @error('slug')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="instructor" class="block text-sm font-medium text-gray-700 mb-1">Instruktur</label>
                    <input type="text" name="instructor" id="instructor" value="{{ old('instructor', $course->instructor) }}" required
                        class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition">
                    @error('instructor')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Deskripsi</label>
                    <textarea name="description" id="description" rows="5" required class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition">{{ old('description', $course->description) }}</textarea>
                    @error('description')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6 grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="price" class="block text-sm font-medium text-gray-700 mb-1">Harga</label>
                        <div class="flex items-center">
                            <span class="px-3 py-2 bg-gray-100 border border-r-0 border-gray-300 rounded-l-lg text-gray-700">Rp</span>
                            <input type="number" name="price" id="price" value="{{ old('price', $course->price) }}" required
                                class="flex-1 px-4 py-2 border border-l-0 rounded-r-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition">
                        </div>
                        @error('price')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex items-center gap-2">
                        <input type="checkbox" name="is_free" id="is_free" value="1" {{ old('is_free', $course->is_free) ? 'checked' : '' }}
                            class="w-4 h-4 text-indigo-600 border-gray-300 rounded focus:ring-indigo-500">
                        <label for="is_free" class="text-sm text-gray-700">Kelas Gratis</label>
                    </div>
                </div>

                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Gambar Saat Ini</label>
                    <div class="mb-4">
                        @if ($course->image)
                            <img src="{{ Storage::url($course->image) }}" alt="{{ $course->title }}" class="max-w-32 max-h-32 object-cover rounded-md border border-gray-200">
                        @else
                            <p class="text-sm text-gray-500">Belum ada gambar.</p>
                        @endif
                    </div>
                    <label for="image" class="block text-sm font-medium text-gray-700 mb-1">Ganti Gambar</label>
                    <input type="file" name="image" id="image" accept="image/*"
                        class="w-full px-4 py-2 border border-dashed border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition"
                        onchange="previewImage(this, 'image-preview-edit')">
                    <p class="mt-1 text-xs text-gray-500">Kosongkan jika tidak ingin mengganti gambar. Maksimal 2 MB.</p>
                    <img id="image-preview-edit" src="" alt="Preview gambar"
                        class="mt-3 max-w-[200px] max-h-[200px] object-cover rounded-lg border border-gray-200 hidden">
                    @error('image')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex justify-end gap-2">
                    <a href="{{ route('admin.courses.index') }}" class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition">Batal</a>
                    <button type="submit" class="px-6 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg font-medium transition">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function previewImage(input, previewId) {
            const preview = document.getElementById(previewId);
            const file = input.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    preview.src = e.target.result;
                    preview.classList.remove('hidden');
                };
                reader.readAsDataURL(file);
            } else {
                preview.src = '';
                preview.classList.add('hidden');
            }
        }
    </script>
@endsection
