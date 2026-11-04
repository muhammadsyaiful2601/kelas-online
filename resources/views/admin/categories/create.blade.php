@extends('layouts.admin')

@section('title', 'Tambah Kategori')

@section('content')
    <div class="max-w-xl mx-auto">
        <h1 class="text-2xl font-bold text-gray-900 mb-6">Tambah Kategori</h1>

        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <form method="POST" action="{{ route('admin.categories.store') }}">
                @csrf

                <div class="mb-4">
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nama Kategori</label>
                    <input type="text" name="name" id="name" value="{{ old('name') }}" required
                        class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition">
                    @error('name')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="slug" class="block text-sm font-medium text-gray-700 mb-1">Slug</label>
                    <input type="text" name="slug" id="slug" value="{{ old('slug') }}" required
                        class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition"
                        placeholder="contoh: pemrograman">
                    <p class="mt-1 text-xs text-gray-500">Slug digunakan dalam URL, contoh: /kategori/pemrograman</p>
                    @error('slug')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Deskripsi</label>
                    <textarea name="description" id="description" rows="4" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition">{{ old('description') }}</textarea>
                    @error('description')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex justify-end gap-2">
                    <a href="{{ route('admin.categories.index') }}" class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition">Batal</a>
                    <button type="submit" class="px-6 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg font-medium transition">Simpan</button>
                </div>
            </form>
        </div>
    </div>
@endsection
