@extends('index')

@section('title', 'Чат: ' . $chat->name)

@section('content')
    <div class="flex min-h-0 flex-1 flex-col">

        {{-- Список сообщений --}}
        <ul role="log" aria-live="polite" aria-label="Сообщения"
            class="min-h-0 flex-1 overflow-y-auto px-1 [scrollbar-color:var(--color-term-border)_var(--color-term-bg)] [scrollbar-width:thin] [&::-webkit-scrollbar-thumb]:bg-term-border [&::-webkit-scrollbar-track]:bg-term-bg [&::-webkit-scrollbar]:w-2">
            @forelse ($messages as $message)
                <x-term.message :time="\Carbon\Carbon::parse($message->created_at)->format('H:i')" :name="$message->sender_id === auth()->id() ? 'Вы' : 'Пользователь #' . $message->sender_id" :sender-id="$message->sender_id"
                    :mine="$message->sender_id === auth()->id()">{{ $message->body }}</x-term.message>
            @empty
                <li class="text-term-magenta">*** Пока нет сообщений</li>
                <li class="text-term-dim">Начните общение первым!<span aria-hidden="true" class="cursor-blink"></span></li>
            @endforelse
        </ul>

        {{-- Форма отправки --}}
        <form action="" method="post" class="flex items-center gap-2 border-t border-term-border px-1 pt-1">
            @csrf

            <label for="message" class="text-term-accent">
                <span aria-hidden="true">&gt;</span><span class="sr-only">Сообщение</span>
            </label>

            <x-term.input type="text" name="message" id="message" placeholder="Напишите сообщение..." required
                autocomplete="off" class="flex-1" />

            <x-term.button type="submit">Отправить</x-term.button>
        </form>

    </div>
@endsection
