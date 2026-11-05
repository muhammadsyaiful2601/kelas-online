@props(['variant' => 'primary'])
@php $styles = ['primary' => 'bg-indigo-600 text-white hover:bg-indigo-700 shadow-sm shadow-indigo-200', 'secondary' => 'border border-slate-300 bg-white text-slate-700 hover:border-indigo-300 hover:text-indigo-700', 'ghost' => 'text-indigo-700 hover:bg-indigo-50']; @endphp
@if ($attributes->has('href'))
    <a {{ $attributes->class(['inline-flex h-11 items-center justify-center gap-2 rounded-xl px-5 text-sm font-semibold transition ui-focus', $styles[$variant] ?? $styles['primary']]) }}>{{ $slot }}</a>
@else
    <button {{ $attributes->class(['inline-flex h-11 items-center justify-center gap-2 rounded-xl px-5 text-sm font-semibold transition ui-focus', $styles[$variant] ?? $styles['primary']]) }}>{{ $slot }}</button>
@endif
