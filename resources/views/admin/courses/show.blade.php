@extends('layouts.admin')

@section('title', 'Detail Kelas')

@section('content')
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-900">Detail Kelas</h1>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200">
            <h2 class="text-lg font-semibold text-gray-900">{{ $course->title }}</h2>
        </div>

        <div class="px-6 py-6 grid grid-cols-1 md:grid-cols-2 gap-8">
            <div>
                @if ($course->image)
                    <img src="{{ Storage::url($course->image) }}" alt="{{ $course->title }}" class="w-full h-48 object-cover rounded-lg border border-gray-200 mb-4">
                @endif
                <div class="flex items-center gap-2 mb-1">
                    <span class="px-2 py-1 text-xs font-semibold rounded-full
                        @if($course->status->value === 'PUBLISHED') bg-green-100 text-green-800 @else bg-yellow-100 text-yellow-800 @endif
                    ">
                        {{ ucfirst(strtolower($course->status->value)) }}
                    </span>
                    @if ($course->is_free)
                        <span class="px-2 py-1 text-xs font-semibold bg-blue-100 text-blue-800 rounded-full">Gratis</span>
                    @endif
                </div>
                <p class="text-sm text-gray-500 mb-2"><strong>Kategori:</strong> {{ $course->category->name }}</p>
                <p class="text-sm text-gray-500 mb-2"><strong>Instruktur:</strong> {{ $course->instructor }}</p>
                <p class="text-sm text-gray-500 mb-2"><strong>Harga:</strong> {{ $course->is_free ? 'Gratis' : 'Rp ' . number_format($course->price, 0, ',', '.') }}</p>
                <p class="text-sm text-gray-500 mb-4"><strong>Slug:</strong> <span class="font-mono">{{ $course->slug }}</span></p>
                <a href="{{ route('admin.courses.edit', $course) }}" class="text-sm text-indigo-600 hover:text-indigo-500 font-medium">Edit Kelas</a>
            </div>

            <div>
                <h3 class="text-sm font-semibold text-gray-900 mb-2 uppercase tracking-wider">Deskripsi</h3>
                <p class="text-gray-600 leading-relaxed">{{ $course->description }}</p>
            </div>
        </div>

        <!-- Pendaftar Kelas -->
        <div class="border-t border-gray-200 bg-gray-50 px-6 py-6">
            <h3 class="text-sm font-semibold text-gray-900 mb-4 uppercase tracking-wider">Daftar Pendaftar ({{ $course->enrollments->count() }})</h3>
            @if ($course->enrollments->count() > 0)
                <div class="overflow-x-auto">
                    <table class="w-full text-left text-sm">
                        <thead>
                            <tr>
                                <th class="px-4 py-2 text-gray-500 font-medium uppercase">Nama</th>
                                <th class="px-4 py-2 text-gray-500 font-medium uppercase">Email</th>
                                <th class="px-4 py-2 text-gray-500 font-medium uppercase">No. HP</th>
                                <th class="px-4 py-2 text-gray-500 font-medium uppercase">Status</th>
                                <th class="px-4 py-2 text-gray-500 font-medium uppercase">Tanggal</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @foreach ($course->enrollments->sortByDesc('created_at') as $enrollment)
                                <tr>
                                    <td class="px-4 py-3 text-gray-900">{{ $enrollment->name }}</td>
                                    <td class="px-4 py-3 text-gray-500">{{ $enrollment->email }}</td>
                                    <td class="px-4 py-3 text-gray-500">{{ $enrollment->phone ?? '-' }}</td>
                                    <td class="px-4 py-3">
                                        <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full
                                            @switch($enrollment->status->value)
                                                @case('PENDING') bg-yellow-100 text-yellow-800 @break
                                                @case('APPROVED') bg-green-100 text-green-800 @break
                                                @case('REJECTED') bg-red-100 text-red-800 @break
                                            @endswitch
                                        ">
                                            {{ ucfirst(strtolower($enrollment->status->value)) }}
                                        </span>
                                    </td>
                                    <td class="px-4 py-3 text-gray-500">{{ $enrollment->created_at->format('d M Y H:i') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <p class="text-center text-gray-500 py-4">Belum ada pendaftar untuk kelas ini.</p>
            @endif
        </div>
    </div>

    <div class="mt-6">
        <a href="{{ route('admin.courses.index') }}" class="text-sm text-indigo-600 hover:text-indigo-500 font-medium">&larr; Kembali ke Daftar Kelas</a>
    </div>
@endsection
