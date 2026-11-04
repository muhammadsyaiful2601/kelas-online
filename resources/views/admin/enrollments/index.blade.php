@extends('layouts.admin')

@section('title', 'Kelola Pendaftar')

@section('content')
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-900">Kelola Pendaftar</h1>
        <p class="text-gray-600">Lihat daftar pendaftar dan perbarui status verifikasi.</p>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center sm:flex-row flex-col gap-3">
            <h2 class="text-lg font-semibold text-gray-900">Daftar Pendaftar</h2>

            <form method="GET" action="{{ route('admin.enrollments.index') }}" class="flex flex-col sm:flex-row gap-3 w-full sm:w-auto">
                <div class="relative w-full sm:min-w-[220px] sm:w-auto">
                    <select name="course_id" id="course_id" class="block h-10 w-full appearance-none bg-none rounded-lg border border-gray-300 bg-white px-3 pr-12 text-sm leading-5 outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500">
                        <option value="">Semua Kelas</option>
                        @foreach ($courses as $course)
                            <option value="{{ $course->id }}" {{ request('course_id') == $course->id ? 'selected' : '' }}>{{ $course->title }}</option>
                        @endforeach
                    </select>
                    <div class="pointer-events-none absolute inset-y-0 right-3 flex items-center">
                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </div>
                </div>

                <div class="relative w-full sm:min-w-[160px] sm:w-auto">
                    <select name="status" id="status" class="block h-10 w-full appearance-none bg-none rounded-lg border border-gray-300 bg-white px-3 pr-12 text-sm leading-5 outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500">
                        <option value="">Semua Status</option>
                        @foreach ($statuses as $status)
                            <option value="{{ $status }}" {{ request('status') == $status ? 'selected' : '' }}>{{ ucfirst(strtolower($status)) }}</option>
                        @endforeach
                    </select>
                    <div class="pointer-events-none absolute inset-y-0 right-3 flex items-center">
                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </div>
                </div>

                <button type="submit" class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg text-sm font-medium transition">Filter</button>
                <a href="{{ route('admin.enrollments.index') }}" class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 text-sm hover:bg-gray-50 transition">Reset</a>
            </form>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-xs font-semibold text-gray-500 uppercase">Kelas</th>
                        <th class="px-6 py-3 text-xs font-semibold text-gray-500 uppercase">Nama</th>
                        <th class="px-6 py-3 text-xs font-semibold text-gray-500 uppercase">Email</th>
                        <th class="px-6 py-3 text-xs font-semibold text-gray-500 uppercase">No. HP</th>
                        <th class="px-6 py-3 text-xs font-semibold text-gray-500 uppercase">Status</th>
                        <th class="px-6 py-3 text-xs font-semibold text-gray-500 uppercase text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse ($enrollments as $enrollment)
                        <tr>
                            <td class="px-6 py-4 text-gray-700">{{ $enrollment->course->title }}</td>
                            <td class="px-6 py-4 text-gray-900">{{ $enrollment->name }}</td>
                            <td class="px-6 py-4 text-gray-500">{{ $enrollment->email }}</td>
                            <td class="px-6 py-4 text-gray-500">{{ $enrollment->phone ?? '-' }}</td>
                            <td class="px-6 py-4">
                                <form method="POST" action="{{ route('admin.enrollments.update', $enrollment) }}">
                                    @csrf
                                    @method('PUT')
                                    <div class="relative w-[112px]">
                                    <select name="status" onchange="this.form.submit()"
                                        class="block h-8 w-full appearance-none bg-none rounded border border-gray-300 bg-white px-2 pr-9 text-xs leading-4 outline-none focus:ring-2 focus:ring-indigo-500
                                            @switch($enrollment->status->value)
                                                @case('PENDING') bg-yellow-50 border-yellow-200 text-yellow-800 @break
                                                @case('APPROVED') bg-green-50 border-green-200 text-green-800 @break
                                                @case('REJECTED') bg-red-50 border-red-200 text-red-800 @break
                                            @endswitch">
                                        <option value="PENDING" {{ $enrollment->status->value === 'PENDING' ? 'selected' : '' }}>Pending</option>
                                        <option value="APPROVED" {{ $enrollment->status->value === 'APPROVED' ? 'selected' : '' }}>Approved</option>
                                        <option value="REJECTED" {{ $enrollment->status->value === 'REJECTED' ? 'selected' : '' }}>Rejected</option>
                                    </select>
                                    <div class="pointer-events-none absolute inset-y-0 right-2 flex items-center">
                                        <svg class="w-3 h-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                        </svg>
                                    </div>
                                    </div>
                                </form>
                            </td>
                            <td class="px-6 py-4 text-right">
                                <a href="{{ route('admin.enrollments.show', $enrollment) }}" class="text-indigo-600 hover:text-indigo-800 text-sm font-medium underline">Detail</a>
                                <span class="text-gray-300 text-xs ml-2">{{ $enrollment->created_at->format('d M Y') }}</span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-4 text-center text-gray-500">Belum ada pendaftar.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{ $enrollments->links() }}
    </div>
@endsection
