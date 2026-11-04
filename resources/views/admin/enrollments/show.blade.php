@extends('layouts.admin')

@section('title', 'Detail Pendaftar')

@section('content')
    <div class="mb-8">
        <div class="flex flex-col gap-5 sm:flex-row sm:items-end sm:justify-between">
            <div>
                <a href="{{ route('admin.enrollments.index') }}" class="mb-3 inline-flex items-center gap-2 text-sm font-medium text-indigo-600 transition hover:text-indigo-700">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Kembali ke pendaftar
                </a>
                <h1 class="text-3xl font-bold tracking-tight text-slate-900">Detail Pendaftar</h1>
                <p class="mt-1 text-sm text-slate-500">Tinjau informasi dan perbarui status pendaftaran kelas.</p>
            </div>
            <div class="inline-flex items-center gap-2 self-start rounded-full border border-slate-200 bg-white px-3 py-2 text-xs font-medium text-slate-500 shadow-sm sm:self-auto">
                <span class="h-2 w-2 rounded-full bg-indigo-500"></span>
                ID #{{ $enrollment->id }}
            </div>
        </div>
    </div>

    <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
        <div class="border-b border-slate-200 px-6 py-6 sm:px-8">
            <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                <div class="flex items-center gap-4">
                    <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-xl bg-indigo-50 text-indigo-600">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM5 21a7 7 0 0114 0"></path>
                        </svg>
                    </div>
                    <div>
                        <h2 class="text-lg font-semibold text-slate-900">{{ $enrollment->name }}</h2>
                        <p class="mt-1 text-sm text-slate-500">Informasi lengkap pendaftaran kelas</p>
                    </div>
                </div>
                <span class="
                    inline-flex w-fit items-center gap-2 rounded-full px-3 py-1.5 text-xs font-semibold
                    @switch($enrollment->status->value)
                        @case('PENDING') bg-amber-50 text-amber-700 ring-1 ring-inset ring-amber-200 @break
                        @case('APPROVED') bg-emerald-50 text-emerald-700 ring-1 ring-inset ring-emerald-200 @break
                        @case('REJECTED') bg-rose-50 text-rose-700 ring-1 ring-inset ring-rose-200 @break
                    @endswitch
                ">
                    <span class="h-1.5 w-1.5 rounded-full bg-current"></span>
                    {{ ucfirst(strtolower($enrollment->status->value)) }}
                </span>
            </div>
        </div>

        <div class="grid grid-cols-1 gap-8 px-6 py-8 sm:px-8 lg:grid-cols-2 lg:gap-x-12">
            <section>
                <div class="mb-4 flex items-center gap-2">
                    <span class="h-5 w-1 rounded-full bg-indigo-500"></span>
                    <h3 class="text-sm font-semibold uppercase tracking-wider text-slate-500">Data pendaftar</h3>
                </div>

                <dl class="divide-y divide-slate-100 rounded-xl border border-slate-200">
                    <div class="flex items-start gap-4 px-4 py-4">
                        <dt class="w-28 shrink-0 text-xs font-medium uppercase tracking-wide text-slate-400">Nama lengkap</dt>
                        <dd class="text-sm font-semibold text-slate-800">{{ $enrollment->name }}</dd>
                    </div>
                    <div class="flex items-start gap-4 px-4 py-4">
                        <dt class="w-28 shrink-0 text-xs font-medium uppercase tracking-wide text-slate-400">Email</dt>
                        <dd class="break-all text-sm font-semibold text-slate-800">{{ $enrollment->email }}</dd>
                    </div>
                    <div class="flex items-start gap-4 px-4 py-4">
                        <dt class="w-28 shrink-0 text-xs font-medium uppercase tracking-wide text-slate-400">Nomor HP</dt>
                        <dd class="text-sm font-semibold text-slate-800">{{ $enrollment->phone ?? '-' }}</dd>
                    </div>
                    <div class="flex items-start gap-4 px-4 py-4">
                        <dt class="w-28 shrink-0 text-xs font-medium uppercase tracking-wide text-slate-400">Tanggal daftar</dt>
                        <dd class="text-sm font-semibold text-slate-800">{{ $enrollment->created_at->format('d M Y, H:i') }}</dd>
                    </div>
                </dl>
            </section>

            <section>
                <div class="mb-4 flex items-center gap-2">
                    <span class="h-5 w-1 rounded-full bg-indigo-500"></span>
                    <h3 class="text-sm font-semibold uppercase tracking-wider text-slate-500">Detail kelas</h3>
                </div>

                <dl class="divide-y divide-slate-100 rounded-xl border border-slate-200">
                    <div class="flex items-start gap-4 px-4 py-4">
                        <dt class="w-28 shrink-0 text-xs font-medium uppercase tracking-wide text-slate-400">Kelas</dt>
                        <dd class="text-sm font-semibold text-slate-800">{{ $enrollment->course->title }}</dd>
                    </div>
                    <div class="flex items-start gap-4 px-4 py-4">
                        <dt class="w-28 shrink-0 text-xs font-medium uppercase tracking-wide text-slate-400">Harga kelas</dt>
                        <dd class="text-sm font-semibold text-slate-800">
                            @if ($enrollment->course->is_free)
                                Gratis
                            @else
                                Rp {{ number_format($enrollment->course->price, 0, ',', '.') }}
                            @endif
                        </dd>
                    </div>
                    <div class="flex items-start gap-4 px-4 py-4">
                        <dt class="w-28 shrink-0 text-xs font-medium uppercase tracking-wide text-slate-400">Status saat ini</dt>
                        <dd class="text-sm font-semibold text-slate-800">{{ ucfirst(strtolower($enrollment->status->value)) }}</dd>
                    </div>
                </dl>
            </section>
        </div>

        <div class="border-t border-slate-200 bg-slate-50/80 px-6 py-6 sm:px-8">
            <div class="flex flex-col gap-5 lg:flex-row lg:items-end lg:justify-between">
                <div>
                    <h3 class="text-sm font-semibold text-slate-900">Perbarui status pendaftaran</h3>
                    <p class="mt-1 text-sm text-slate-500">Pilih status terbaru untuk pendaftar ini.</p>
                </div>
                <form method="POST" action="{{ route('admin.enrollments.update', $enrollment) }}" class="flex w-full flex-col gap-3 sm:flex-row lg:w-auto">
                    @csrf
                    @method('PUT')
                    <div class="relative min-w-52">
                        <select name="status" class="block h-11 w-full appearance-none rounded-lg border border-slate-300 bg-white px-3 pr-10 text-sm text-slate-700 outline-none transition focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500">
                            <option value="PENDING" {{ $enrollment->status->value === 'PENDING' ? 'selected' : '' }}>Pending</option>
                            <option value="APPROVED" {{ $enrollment->status->value === 'APPROVED' ? 'selected' : '' }}>Disetujui</option>
                            <option value="REJECTED" {{ $enrollment->status->value === 'REJECTED' ? 'selected' : '' }}>Ditolak</option>
                        </select>
                        <svg class="pointer-events-none absolute right-3 top-1/2 h-4 w-4 -translate-y-1/2 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </div>
                    <button type="submit" class="inline-flex h-11 items-center justify-center gap-2 rounded-lg bg-indigo-600 px-5 text-sm font-semibold text-white shadow-sm transition hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        Simpan perubahan
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection