@props(['time', 'name', 'senderId' => null, 'mine' => false])

@php
    $colors = ['text-term-cyan', 'text-term-yellow', 'text-term-magenta', 'text-term-accent', 'text-term-red'];
    $nick = $mine ? 'text-term-accent' : $colors[(int) $senderId % 5];
@endphp

<li {{ $attributes->class('flex gap-1') }}>
    <span class="shrink-0 tabular-nums text-term-dim">[{{ $time }}]</span>
    <span class="shrink-0 {{ $nick }}">
        @if ($mine)
            <span aria-hidden="true">»</span>
        @endif&lt;{{ $name }}&gt;
    </span>
    <span class="min-w-0 flex-1 whitespace-pre-wrap break-words text-term-fg">{{ $slot }}</span>
</li>
