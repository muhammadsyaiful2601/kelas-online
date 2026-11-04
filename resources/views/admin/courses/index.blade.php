@extends('layouts.admin')

@section('title', 'Kelola Kelas')

@section('content')
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-900">Kelola Kelas</h1>
        <p class="text-gray-600">Kelola data kelas, upload gambar, dan atur status publikasi.</p>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center sm:flex-row flex-col gap-3">
            <h2 class="text-lg font-semibold text-gray-900">Daftar Kelas</h2>
            <a href="{{ route('admin.courses.create') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition">
                Tambah Kelas
            </a>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-sm font-semibold text-gray-500 uppercase">Gambar</th>
                        <th class="px-6 py-3 text-sm font-semibold text-gray-500 uppercase">Judul</th>
                        <th class="px-6 py-3 text-sm font-semibold text-gray-500 uppercase">Kategori</th>
                        <th class="px-6 py-3 text-sm font-semibold text-gray-500 uppercase">Harga</th>
                        <th class="px-6 py-3 text-sm font-semibold text-gray-500 uppercase">Status</th>
                        <th class="px-6 py-3 text-sm font-semibold text-gray-500 uppercase text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse ($courses as $course)
                        <tr>
                            <td class="px-6 py-4">
                                @if ($course->image)
                                    <img src="{{ Storage::url($course->image) }}" alt="{{ $course->title }}" class="w-12 h-12 object-cover rounded-md border border-gray-200">
                                @else
                                    <div class="w-12 h-12 bg-gray-100 rounded-md flex items-center justify-center text-gray-400 text-xs">Tanpa Gambar</div>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-900">{{ $course->title }}</td>
                            <td class="px-6 py-4 text-sm text-gray-500">{{ $course->category->name }}</td>
                            <td class="px-6 py-4 text-sm text-gray-900">
                                {{ $course->is_free ? 'Gratis' : 'Rp ' . number_format($course->price, 0, ',', '.') }}
                            </td>
                            <td class="px-6 py-4 text-sm">
                                <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full
                                    @if($course->status->value === 'PUBLISHED') bg-green-100 text-green-800 @else bg-yellow-100 text-yellow-800 @endif
                                ">
                                    {{ ucfirst(strtolower($course->status->value)) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-sm text-right">
                                <a href="{{ route('admin.courses.show', $course) }}" class="text-indigo-600 hover:text-indigo-500 font-medium mr-3">Detail</a>
                                <a href="{{ route('admin.courses.edit', $course) }}" class="text-indigo-600 hover:text-indigo-500 font-medium mr-3">Edit</a>
                                <form method="POST" action="{{ route('admin.courses.destroy', $course) }}" class="inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-500 font-medium" onclick="return confirm('Yakin ingin menghapus kelas ini?')">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-4 text-center text-gray-500">Belum ada kelas.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{ $courses->links() }}
    </div>
@endsection
