@props(['variant' => 'primary'])
@php $styles = ['primary' => 'bg-indigo-50 text-indigo-700 ring-indigo-200', 'success' => 'bg-emerald-50 text-emerald-700 ring-emerald-200', 'muted' => 'bg-slate-100 text-slate-600 ring-slate-200']; @endphp
<span {{ $attributes->merge(['class' => 'inline-flex items-center rounded-full px-2.5 py-1 text-xs font-semibold ring-1 ring-inset '.$styles[$variant]]) }}>{{ $slot }}</span>
