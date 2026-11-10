@props(['title' => null, 'active' => false, 'tag' => 'h2'])

<section
    {{ $attributes->class([
        'relative bg-term-panel p-2 pt-3',
        'border border-term-border focus-within:border-term-border-active' => !$active,
        'border-2 border-double border-term-border-active' => $active,
    ]) }}>
    @if (trim((string) $title) !== '')
        <{{ $tag }} class="absolute -top-2.5 left-2 bg-term-bg px-1 uppercase text-term-accent">┤
            {{ $title }} ├</{{ $tag }}>
    @endif
    {{ $slot }}
</section>
