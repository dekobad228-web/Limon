<input
    {{ $attributes->merge([
        'type' => 'text',
        'class' =>
            'min-w-0 border-b border-dashed border-term-border bg-transparent px-1 text-term-fg caret-term-accent outline-none placeholder:text-term-dim focus:border-solid focus:border-term-accent',
    ]) }}>
