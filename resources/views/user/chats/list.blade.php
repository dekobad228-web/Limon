@extends('index')

@section('title', 'Чаты')

@section('content')
    <ul>
        @forelse ($chats as $row)
            <li>
                <a href="{{ route('user.chats.detail.index', [request()->user(), $row['chat']['token']]) }}"
                    class="group block px-1 hover:bg-term-sel-bg hover:text-term-sel-fg focus-visible:bg-term-sel-bg focus-visible:text-term-sel-fg focus-visible:outline-none">

                    <span class="flex items-baseline gap-2">
                        <span aria-hidden="true" class="invisible group-hover:visible group-focus-visible:visible">▶</span>
                        <span
                            class="shrink-0 text-term-cyan group-hover:text-term-sel-fg group-focus-visible:text-term-sel-fg">
                            [{{ mb_strtoupper(mb_substr($row['chat']['name'], 0, 1)) }}]
                        </span>
                        <span class="min-w-0 flex-1 truncate">{{ $row['chat']['name'] }}</span>
                        <span
                            class="shrink-0 tabular-nums text-term-dim group-hover:text-term-sel-fg group-focus-visible:text-term-sel-fg">
                            {{ $row['message']['created_at'] ?? $row['chat']['created_at'] }}
                        </span>
                    </span>

                    <span
                        class="block truncate pl-[6ch] text-term-dim group-hover:text-term-sel-fg group-focus-visible:text-term-sel-fg">
                        {{ $row['message']['body'] ?? 'Нет сообщений' }}
                    </span>
                </a>
            </li>
        @empty
            <li class="text-term-dim">
                -- Пока нет чатов --<span aria-hidden="true" class="cursor-blink"></span>
            </li>
        @endforelse
    </ul>
@endsection
