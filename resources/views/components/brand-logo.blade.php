@props(['dark' => false, 'size' => 'md'])

@php
    $sizes = ['sm' => ['h-6 w-6', 'text-sm'], 'md' => ['h-8 w-8', 'text-base'], 'lg' => ['h-10 w-10', 'text-lg']];
    [$mark, $word] = $sizes[$size] ?? $sizes['md'];
@endphp
<span {{ $attributes->merge(['class' => 'inline-flex items-center gap-2.5']) }}>
    <img src="{{ asset('images/logo.jpg') }}" alt="KelasOnline" class="{{ $mark }} rounded-lg">
    <span class="{{ $word }} font-bold tracking-tight {{ $dark ? 'text-white' : 'text-indigo-600' }}">Kelas<span class="{{ $dark ? 'text-indigo-200' : 'text-slate-900' }}">Online</span></span>
</span>
