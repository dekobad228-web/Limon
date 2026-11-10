@extends('index')

@section('title', 'Чаты')

@section('content')
    <div class="space-y-2">
        @forelse ($chats as $row)
            <a href="{{ route('user.chats.detail.index', [request()->user(), $row['chat']['token']]) }}"
                class="group flex items-center gap-4 rounded-2xl border border-gray-100 bg-white p-4 shadow-sm transition hover:border-blue-200 hover:bg-blue-50/30 hover:shadow-md">

                <div
                    class="flex h-14 w-14 shrink-0 items-center justify-center rounded-full bg-linear-to-br from-blue-500 to-indigo-600 text-lg font-semibold text-white shadow-sm">
                    {{ mb_strtoupper(mb_substr($row['chat']['name'], 0, 1)) }}
                </div>

                <div class="min-w-0 flex-1">
                    <div class="flex items-center justify-between gap-3">
                        <h2 class="truncate text-sm font-semibold text-gray-900 group-hover:text-blue-600">
                            {{ $row['chat']['name'] }}
                        </h2>

                        <span class="shrink-0 text-xs text-gray-400">
                            {{ $row['message']['created_at'] ?? $row['chat']['created_at'] }}
                        </span>
                    </div>

                    <div class="mt-1 flex items-center justify-between gap-3">
                        <p class="truncate text-sm text-gray-500">
                            {{ $row['message']['body'] ?? 'Нет сообщений' }}
                        </p>
                    </div>
                </div>
            </a>
        @empty
            <div class="rounded-2xl border border-dashed border-gray-300 bg-white px-6 py-14 text-center">
                <div class="mx-auto flex h-14 w-14 items-center justify-center rounded-full bg-gray-100 text-gray-400">
                    <svg class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M8 10h8M8 14h5m-9 6 2.5-3H18a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2H6a2 2 0 0 0-2 2v14Z" />
                    </svg>
                </div>
                <h2 class="mt-4 text-sm font-semibold text-gray-900">Пока нет чатов</h2>
            </div>
        @endforelse
    </div>
@endsection
