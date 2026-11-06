@extends('layouts.admin')

@section('title', 'Dashboard Admin')

@section('content')
    <div class="mb-8">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <p class="text-sm font-medium text-indigo-600 mb-2">Ringkasan aktivitas</p>
                <h1 class="text-3xl font-bold tracking-tight text-slate-900 mb-2">Dashboard Admin</h1>
                <p class="text-slate-500">Selamat datang kembali, {{ auth()->user()->name }}.</p>
            </div>

            <div class="flex w-full flex-col gap-3 sm:w-auto sm:flex-row">
                <a href="{{ route('admin.enrollments.export') }}"
                   class="inline-flex w-full items-center justify-center gap-2 rounded-xl bg-slate-900 px-5 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-slate-800 focus:outline-none focus:ring-2 focus:ring-slate-500 focus:ring-offset-2 sm:w-auto">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                    Export Excel
                </a>
                <a href="{{ route('admin.courses.create') }}"
                   class="inline-flex w-full items-center justify-center gap-2 rounded-xl bg-indigo-600 px-5 py-3 text-sm font-semibold text-white shadow-sm shadow-indigo-200 transition hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 sm:w-auto">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                    Tambah Kelas
                </a>
            </div>
        </div>
    </div>

    <div class="mb-8 grid grid-cols-2 gap-3 sm:gap-4 xl:grid-cols-4">
        @php
            $stats = [
                [
                    'title' => 'Total Kategori',
                    'value' => $totalCategories,
                    'icon' => 'M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6',
                    'gradient' => 'from-indigo-100 to-indigo-200',
                    'iconColor' => 'text-indigo-600',
                    'subtitle' => 'Kategori kelas aktif',
                ],
                [
                    'title' => 'Total Kelas',
                    'value' => $totalCourses,
                    'icon' => 'M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4',
                    'gradient' => 'from-blue-100 to-blue-200',
                    'iconColor' => 'text-blue-600',
                    'subtitle' => 'Kelas dalam sistem',
                ],
                [
                    'title' => 'Total Pendaftar',
                    'value' => $totalEnrollments,
                    'icon' => 'M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z',
                    'gradient' => 'from-purple-100 to-purple-200',
                    'iconColor' => 'text-purple-600',
                    'subtitle' => 'Pengguna terdaftar',
                ],
                [
                    'title' => 'Kelas Publik',
                    'value' => $publishedCourses,
                    'icon' => 'M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z',
                    'gradient' => 'from-green-100 to-green-200',
                    'iconColor' => 'text-green-600',
                    'subtitle' => 'Tampil di landing page',
                ],
            ]
        @endphp

        @foreach ($stats as $stat)
            <div class="group min-w-0 rounded-2xl border border-slate-200 bg-white p-4 shadow-sm transition-all duration-200 hover:-translate-y-0.5 hover:shadow-md sm:p-5">
                <div class="mb-4 flex items-center justify-between">
                    <div class="flex h-11 w-11 items-center justify-center rounded-xl {{ $stat['gradient'] }} transition-transform duration-200 group-hover:scale-110">
                        <svg class="w-5 h-5 {{ $stat['iconColor'] }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{$stat['icon']}}"></path></svg>
                    </div>
                </div>
                <p class="mb-1 text-[10px] font-semibold uppercase tracking-wider text-slate-400 sm:text-xs">{{ $stat['title'] }}</p>
                <p class="mb-1 text-2xl font-bold tracking-tight text-slate-900 sm:text-3xl">{{ $stat['value'] }}</p>
                <p class="text-xs text-slate-400">{{ $stat['subtitle'] }}</p>
            </div>
        @endforeach
    </div>

    <div class="mb-8 grid grid-cols-1 gap-6 lg:grid-cols-3">

        <!-- Recent Enrollments -->
        <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm lg:col-span-2">
            <div class="flex items-center justify-between border-b border-slate-100 px-6 py-5">
                <h2 class="text-lg font-semibold text-slate-900">Pendaftar Terbaru</h2>
                <a href="{{ route('admin.enrollments.index') }}"
                   class="text-sm font-medium text-indigo-600 hover:text-indigo-700 flex items-center gap-1 transition">
                    Lihat semua <span>→</span>
                </a>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full min-w-[680px] text-left">
                    <thead>
                        <tr class="border-b border-slate-50 bg-slate-50">
                            <th class="px-6 py-3 text-xs font-semibold text-slate-400 uppercase tracking-wider">Nama</th>
                            <th class="px-6 py-3 text-xs font-semibold text-slate-400 uppercase tracking-wider">Email</th>
                            <th class="px-6 py-3 text-xs font-semibold text-slate-400 uppercase tracking-wider">Kelas</th>
                            <th class="px-6 py-3 text-xs font-semibold text-slate-400 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-3 text-xs font-semibold text-slate-400 uppercase tracking-wider text-right">Tanggal</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @forelse ($recentEnrollments as $enrollment)
                            <tr class="hover:bg-slate-50 transition-colors duration-150">
                                <td class="px-6 py-4 text-sm text-slate-900 font-medium">{{ $enrollment->name }}</td>
                                <td class="px-6 py-4 text-sm text-slate-500">{{ $enrollment->email }}</td>
                                <td class="px-6 py-4 text-sm text-slate-700">{{ $enrollment->course->title }}</td>
                                <td class="px-6 py-4 text-sm">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium leading-none
                                        @switch($enrollment->status->value)
                                            @case('PENDING') bg-yellow-100 text-yellow-800 border border-yellow-200 @break
                                            @case('APPROVED') bg-green-100 text-green-800 border border-green-200 @break
                                            @case('REJECTED') bg-red-100 text-red-800 border border-red-200 @break
                                        @endswitch
                                    ">
                                        {{ ucfirst(strtolower($enrollment->status->value)) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-sm text-slate-400 text-right">{{ $enrollment->created_at->format('d M Y') }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-12 text-center">
                                    <div class="flex flex-col items-center gap-2">
                                        <svg class="w-8 h-8 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path></svg>
                                        <p class="text-sm font-medium text-slate-500">Belum ada pendaftar</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="flex h-full flex-col overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
            <div class="border-b border-slate-100 px-6 py-5">
                <h2 class="text-lg font-semibold text-slate-900">Aksi Cepat</h2>
            </div>

            <div class="p-6 space-y-3">
                <a href="{{ route('admin.categories.index') }}"
                   class="flex items-center gap-3 px-4 py-3 rounded-xl bg-slate-50 hover:bg-indigo-50 hover:text-indigo-700 text-slate-700 font-medium transition-all border border-transparent hover:border-indigo-100">
                    <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                    Kelola Kategori
                </a>
                <a href="{{ route('admin.courses.index') }}"
                   class="flex items-center gap-3 px-4 py-3 rounded-xl bg-slate-50 hover:bg-indigo-50 hover:text-indigo-700 text-slate-700 font-medium transition-all border border-transparent hover:border-indigo-100">
                    <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"></path></svg>
                    Kelola Kelas
                </a>
                <a href="{{ route('admin.enrollments.index') }}"
                   class="flex items-center gap-3 px-4 py-3 rounded-xl bg-slate-50 hover:bg-indigo-50 hover:text-indigo-700 text-slate-700 font-medium transition-all border border-transparent hover:border-indigo-100">
                    <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                    Verifikasi Pendaftar
                </a>
                <a href="{{ route('admin.enrollments.export') }}"
                   class="flex items-center gap-3 px-4 py-3 rounded-xl bg-gray-900 hover:bg-gray-800 text-white font-medium transition-all">
                    <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                    Export Excel Pendaftar
                </a>
            </div>

            <div class="mt-auto p-6 border-t border-slate-100 bg-slate-50">
                <h4 class="text-xs font-semibold text-slate-400 uppercase tracking-wider mb-3">Info Sistem</h4>
                <ul class="space-y-2 text-sm text-slate-500">
                    <li class="flex justify-between">
                        <span>PHP</span>
                        <span class="font-mono text-slate-700">8.4.x</span>
                    </li>
                    <li class="flex justify-between">
                        <span>Laravel</span>
                        <span class="font-mono text-slate-700">13.x</span>
                    </li>
                    <li class="flex justify-between">
                        <span>Database</span>
                        <span class="font-mono text-slate-700">MySQL</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>

@endsection
