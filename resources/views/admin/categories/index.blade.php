@extends('layouts.admin')

@section('title', 'Kelola Kategori')

@section('content')
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-900">Kelola Kategori</h1>
        <p class="text-gray-600">Kelola data kategori kelas.</p>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center sm:flex-row flex-col gap-3">
            <h2 class="text-lg font-semibold text-gray-900">Daftar Kategori</h2>
            <a href="{{ route('admin.categories.create') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition">
                Tambah Kategori
            </a>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-sm font-semibold text-gray-500 uppercase">Nama</th>
                        <th class="px-6 py-3 text-sm font-semibold text-gray-500 uppercase">Slug</th>
                        <th class="px-6 py-3 text-sm font-semibold text-gray-500 uppercase">Deskripsi</th>
                        <th class="px-6 py-3 text-sm font-semibold text-gray-500 uppercase text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse ($categories as $category)
                        <tr>
                            <td class="px-6 py-4 text-sm text-gray-900">{{ $category->name }}</td>
                            <td class="px-6 py-4 text-sm text-gray-500 font-mono">{{ $category->slug }}</td>
                            <td class="px-6 py-4 text-sm text-gray-500">{{ $category->description ?? '-' }}</td>
                            <td class="px-6 py-4 text-sm text-right">
                                <a href="{{ route('admin.categories.edit', $category) }}" class="text-indigo-600 hover:text-indigo-500 font-medium">Edit</a>
                                <form method="POST" action="{{ route('admin.categories.destroy', $category) }}" class="inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-500 font-medium ml-3" onclick="return confirm('Yakin ingin menghapus kategori ini? Data kelas terkait akan ikut terhapus.')">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-4 text-center text-gray-500">Belum ada kategori.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{ $categories->links() }}
    </div>
@endsection
