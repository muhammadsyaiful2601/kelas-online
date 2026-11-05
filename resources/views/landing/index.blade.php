<x-public-layout>
    <x-slot:title>KelasOnline — Belajar tanpa batas</x-slot:title>

    {{-- Hero --}}
    <section class="relative isolate overflow-hidden bg-gradient-to-br from-slate-950 via-brand-dark to-indigo-600 text-white">
        <div class="absolute inset-0 opacity-30"
             style="background-image: radial-gradient(circle at 15% 25%, #818cf8 0, transparent 26%), radial-gradient(circle at 85% 80%, #c4b5fd 0, transparent 24%)"></div>

        <div class="relative mx-auto grid max-w-7xl items-center gap-12 px-4 py-16 sm:px-6 sm:py-20 lg:grid-cols-2 lg:px-8 lg:py-24">
            <div>
                <p class="mb-4 text-sm font-semibold uppercase tracking-[.2em] text-indigo-200">Belajar tanpa batas</p>
                <h1 class="max-w-xl text-4xl font-bold leading-tight tracking-tight sm:text-5xl">
                    Kembangkan kemampuan untuk peluang yang lebih besar.
                </h1>
                <p class="mt-6 max-w-xl text-base leading-7 text-indigo-100 sm:text-lg">
                    Temukan kelas terarah dari instruktur terpercaya, lalu belajar dengan langkah yang jelas.
                </p>
                <div class="mt-8 flex flex-col gap-3 sm:flex-row">
                    <a href="#kelas" class="inline-flex h-12 items-center justify-center rounded-xl bg-white px-6 text-sm font-semibold text-indigo-700 shadow-lg transition hover:bg-indigo-50 ui-focus">
                        Jelajahi Kelas <span class="ml-2">→</span>
                    </a>
                </div>
            </div>

            <div class="relative mx-auto w-full max-w-md" aria-hidden="true">
                <div class="absolute -inset-6 rounded-[2rem] bg-indigo-400/20 blur-2xl"></div>
                <div class="relative rotate-2 rounded-2xl border border-white/20 bg-white/10 p-4 shadow-2xl backdrop-blur">
                    <div class="rounded-xl bg-white p-5 text-slate-900 shadow-lg">
                        <div class="flex items-center justify-between">
                            <span class="rounded-full bg-indigo-50 px-3 py-1 text-xs font-semibold text-indigo-700">Kelas Pilihan</span>
                            <span class="flex h-9 w-9 items-center justify-center rounded-xl bg-indigo-600 text-white">✓</span>
                        </div>
                        <div class="mt-5 h-3 w-3/4 rounded-full bg-slate-200"></div>
                        <div class="mt-3 h-3 w-1/2 rounded-full bg-slate-100"></div>
                        <div class="mt-7 flex items-center justify-between border-t border-slate-100 pt-4">
                            <span class="text-sm text-slate-500">Belajar sesuai ritmemu</span>
                            <span class="text-sm font-bold text-indigo-600">Mulai →</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="relative border-t border-white/10 bg-slate-950/20">
            <dl class="mx-auto grid max-w-7xl grid-cols-3 divide-x divide-white/10 px-4 sm:px-6 lg:px-8">
                @foreach ([['Kelas tersedia', $stats['courses']], ['Peserta terdaftar', $stats['enrollments']], ['Kategori', $stats['categories']]] as [$label, $value])
                    <div class="py-5 text-center">
                        <dt class="text-xs text-indigo-200">{{ $label }}</dt>
                        <dd class="mt-1 text-xl font-bold">{{ number_format($value) }}</dd>
                    </div>
                @endforeach
            </dl>
        </div>
    </section>

    {{-- Class catalogue --}}
    <section id="kelas" class="scroll-mt-20 px-4 py-16 sm:px-6 lg:px-8">
        <div class="mx-auto max-w-7xl">
            <div class="mb-8 flex flex-col justify-between gap-3 sm:flex-row sm:items-end">
                <div>
                    <p class="text-sm font-semibold text-indigo-600">Temukan kelasmu</p>
                    <h2 class="mt-1 text-3xl font-bold tracking-tight text-slate-900">Kelas terbaru untuk Anda</h2>
                </div>
                <p class="text-sm text-slate-500">{{ $courses->total() }} kelas ditemukan</p>
            </div>

            <form method="GET" action="{{ route('landing.index') }}" class="ui-card mb-8 grid gap-4 p-4 md:grid-cols-[minmax(0,1fr)_minmax(180px,.55fr)_auto] md:items-end">
                <div>
                    <label for="search" class="mb-1.5 block text-sm font-medium text-slate-700">Cari kelas</label>
                    <div class="relative">
                        <svg class="pointer-events-none absolute left-3 top-1/2 h-5 w-5 -translate-y-1/2 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m21 21-4.35-4.35m2.35-5.65a8 8 0 11-16 0 8 8 0 0116 0z"/>
                        </svg>
                        <input id="search" type="search" name="search" value="{{ request('search') }}" placeholder="Judul atau deskripsi kelas..." class="ui-control w-full pl-10">
                    </div>
                </div>
                <div>
                    <label for="category_id" class="mb-1.5 block text-sm font-medium text-slate-700">Kategori</label>
                    <select id="category_id" name="category_id" class="ui-control w-full">
                        <option value="">Semua kategori</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" @selected(request('category_id') == $category->id)>{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="flex gap-2">
                    <x-button type="submit" class="flex-1">Tampilkan</x-button>
                    @if(request()->filled('search') || request()->filled('category_id'))
                        <a href="{{ route('landing.index') }}" class="inline-flex h-11 items-center justify-center rounded-xl border border-slate-300 px-4 text-sm font-semibold text-slate-700 transition hover:bg-slate-50 ui-focus">Reset</a>
                    @endif
                </div>
            </form>

            @if ($courses->count())
                <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
                    @foreach ($courses as $course)
                        <x-course-card :course="$course" />
                    @endforeach
                </div>
            @else
                <div class="ui-card py-14 text-center">
                    <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-2xl bg-indigo-50 text-indigo-600">⌕</div>
                    <h3 class="mt-5 text-lg font-bold text-slate-900">Belum ada kelas yang cocok</h3>
                    <p class="mt-2 text-sm text-slate-500">Coba ubah kata kunci atau pilih kategori lain.</p>
                    @if(request()->filled('search') || request()->filled('category_id'))
                        <a href="{{ route('landing.index') }}" class="mt-6 inline-flex h-11 items-center justify-center rounded-xl bg-indigo-600 px-5 text-sm font-semibold text-white ui-focus">Reset filter</a>
                    @endif
                </div>
            @endif

            <div class="mt-10">{{ $courses->links() }}</div>
        </div>
    </section>

    {{-- How it works --}}
    <section id="cara-kerja" class="scroll-mt-20 border-y border-slate-200 bg-white px-4 py-16 sm:px-6 lg:px-8">
        <div class="mx-auto max-w-7xl">
            <p class="text-sm font-semibold text-indigo-600">Cara kerja</p>
            <h2 class="mt-1 text-3xl font-bold tracking-tight">Mulai belajar dalam tiga langkah</h2>
            <div class="mt-10 grid gap-6 md:grid-cols-3">
                @foreach ([['01', 'Daftar akun', 'Buat akun gratis untuk menyimpan pilihan kelas Anda.'], ['02', 'Pilih kelas', 'Cari kelas sesuai minat dan tujuan belajar Anda.'], ['03', 'Verifikasi lalu belajar', 'Kami verifikasi pendaftaran, lalu Anda siap memulai.']] as [$number, $title, $text])
                    <article class="ui-card p-6">
                        <span class="inline-flex h-10 w-10 items-center justify-center rounded-xl bg-indigo-50 text-sm font-bold text-indigo-700">{{ $number }}</span>
                        <h3 class="mt-5 text-lg font-bold">{{ $title }}</h3>
                        <p class="mt-2 text-sm leading-6 text-slate-500">{{ $text }}</p>
                    </article>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Benefits --}}
    <section class="px-4 py-16 sm:px-6 lg:px-8">
        <div class="mx-auto max-w-7xl">
            <p class="text-sm font-semibold text-indigo-600">Kenapa KelasOnline</p>
            <h2 class="mt-1 text-3xl font-bold tracking-tight">Belajar lebih fokus, progres lebih jelas</h2>
            <div class="mt-10 grid gap-6 sm:grid-cols-2 lg:grid-cols-4">
                @foreach ([['◷', 'Fleksibel', 'Belajar dari mana saja, sesuai ritme Anda.'], ['✓', 'Terarah', 'Kelas dirancang untuk langkah belajar yang jelas.'], ['☆', 'Instruktur tepercaya', 'Belajar langsung dari praktisi berpengalaman.'], ['◉', 'Akses praktis', 'Pendaftaran mudah dengan status yang transparan.']] as [$icon, $title, $text])
                    <article class="rounded-2xl p-2">
                        <span class="flex h-11 w-11 items-center justify-center rounded-xl bg-indigo-100 text-lg text-indigo-700">{{ $icon }}</span>
                        <h3 class="mt-4 font-bold text-slate-900">{{ $title }}</h3>
                        <p class="mt-2 text-sm leading-6 text-slate-500">{{ $text }}</p>
                    </article>
                @endforeach
            </div>
        </div>
    </section>
</x-public-layout>
