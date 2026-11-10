@props(['danger' => false])

@php
    $classes =
        'px-1 focus-visible:outline-none disabled:pointer-events-none disabled:text-term-dim disabled:line-through ' .
        ($danger
            ? 'text-term-red hover:bg-term-red hover:text-term-bg focus-visible:bg-term-red focus-visible:text-term-bg'
            : 'text-term-accent hover:bg-term-sel-bg hover:text-term-sel-fg focus-visible:bg-term-sel-bg focus-visible:text-term-sel-fg');
@endphp

@if ($attributes->has('href'))
    <a {{ $attributes->merge(['class' => $classes]) }}>[ {{ $slot }} ]</a>
@else
    <button {{ $attributes->merge(['type' => 'submit', 'class' => $classes]) }}>[ {{ $slot }} ]</button>
@endif
