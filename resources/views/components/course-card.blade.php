@props(['course'])

<article {{ $attributes->merge(['class' => 'ui-card group flex h-full min-w-0 flex-col overflow-hidden transition duration-200 hover:-translate-y-1 hover:shadow-lg']) }}>
    @if ($course->image)
        <img
            src="{{ \Illuminate\Support\Facades\Storage::url($course->image) }}"
            alt="{{ $course->title }}"
            loading="lazy"
            class="aspect-video w-full object-cover"
        >
    @else
        <div class="relative flex aspect-video items-center justify-center overflow-hidden bg-gradient-to-br from-indigo-700 via-indigo-600 to-violet-500 text-white" role="img" aria-label="Ilustrasi kelas {{ $course->category->name }}">
            <div class="absolute -right-6 -top-8 h-28 w-28 rounded-full border border-white/20"></div>
            <div class="absolute -bottom-10 -left-6 h-32 w-32 rounded-full bg-white/10"></div>
            <svg class="relative h-12 w-12" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v11.494m0-11.494A4.5 4.5 0 0116.5 3.5H19v14.75h-2.5A4.5 4.5 0 0012 20.5m0-14.247A4.5 4.5 0 007.5 3.5H5v14.75h2.5A4.5 4.5 0 0112 20.5"/>
            </svg>
        </div>
    @endif

    <div class="flex min-w-0 flex-1 flex-col p-5">
        <div class="mb-3 flex items-center justify-between gap-3">
            <x-badge>{{ $course->category->name }}</x-badge>
            <span class="inline-flex items-center gap-1 text-xs text-slate-500">
                <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19a6 6 0 00-12 0m6-7a3 3 0 100-6 3 3 0 000 6zm4 3a4 4 0 014 4m-4-7a3 3 0 000-6"/>
                </svg>
                {{ $course->enrollments_count }} peserta
            </span>
        </div>

        <h3 class="line-clamp-2 text-lg font-bold leading-6 text-slate-900">
            <a href="{{ route('landing.show', $course->slug) }}" class="hover:text-indigo-700">{{ $course->title }}</a>
        </h3>
        <p class="mt-2 line-clamp-2 text-sm leading-6 text-slate-500">{{ $course->description }}</p>

        <div class="mt-4 flex items-center justify-between gap-3 text-sm">
            <span class="truncate text-slate-600">{{ $course->instructor ?: 'Instruktur KelasOnline' }}</span>
            @if($course->is_free)
                <x-badge variant="success">Gratis</x-badge>
            @else
                <span class="shrink-0 font-bold text-slate-900">Rp {{ number_format($course->price, 0, ',', '.') }}</span>
            @endif
        </div>

        <x-button href="{{ route('landing.show', $course->slug) }}" class="mt-5 w-full">
            Lihat Detail &amp; Daftar
            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
            </svg>
        </x-button>
    </div>
</article>
