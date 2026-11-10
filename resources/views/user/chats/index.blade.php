@extends('index')

@section('title', 'Чат: ' . $chat->name)

@section('content')
<div
    class="flex h-[calc(100vh-220px)] min-h-[400px] flex-col overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm">

    {{-- Список сообщений --}}
    <div class="flex-1 space-y-5 overflow-y-auto p-5 sm:p-6">
        @forelse ($messages as $message)
        <div class="flex {{ $message->sender_id === auth()->id() ? 'justify-end' : 'justify-start' }}">
            <div class="max-w-[85%] sm:max-w-[70%]">

                <div
                    class="mb-1 flex items-center gap-2 {{ $message->sender_id === auth()->id() ? 'justify-end' : 'justify-start' }}">
                    <span class="text-xs font-semibold text-gray-600">
                        {{ $message->sender_id === auth()->id() ? 'Вы' : 'Пользователь #' . $message->sender_id }}
                    </span>

                    <span class="text-xs text-gray-400">
                        {{ \Carbon\Carbon::parse($message->created_at)->format('H:i') }}
                    </span>
                </div>

                <div class="rounded-2xl px-4 py-3 {{ $message->sender_id === auth()->id()
                            ? 'rounded-br-sm bg-blue-600 text-white'
                            : 'rounded-bl-sm bg-gray-100 text-gray-900' }}">
                    <p class="break-words text-sm leading-relaxed">
                        {{ $message->body }}
                    </p>
                </div>

            </div>
        </div>
        @empty
        <div class="flex h-full flex-col items-center justify-center text-center">
            <div class="mb-3 rounded-full bg-gray-100 p-4">
                <svg class="h-7 w-7 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                        d="M8 10h8M8 14h4m-9 5 2.5-3H18a2 2 0 0 0 2-2V5a2 2 0 0 0-2-2H4a2 2 0 0 0-2 2v9a2 2 0 0 0 2 2v4z" />
                </svg>
            </div>

            <p class="font-medium text-gray-900">Пока нет сообщений</p>
            <p class="mt-1 text-sm text-gray-500">Начните общение первым!</p>
        </div>
        @endforelse
    </div>

    {{-- Форма отправки --}}
    <div class="border-t border-gray-200 bg-gray-50 p-4 sm:p-5">
        <form action="" method="post" class="flex items-center gap-3">
            @csrf

            <input type="text" name="message" id="message" placeholder="Напишите сообщение..." required
                autocomplete="off"
                class="min-w-0 flex-1 rounded-xl border border-gray-300 bg-white px-4 py-3 text-sm text-gray-900 outline-none transition placeholder:text-gray-400 focus:border-blue-500 focus:ring-2 focus:ring-blue-100">

            <button type="submit"
                class="shrink-0 rounded-xl bg-blue-600 px-5 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                Отправить
            </button>
        </form>
    </div>

</div>
@endsection