<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laravel') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="h-screen w-screen overflow-hidden bg-term-bg font-mono text-sm leading-5 text-term-fg antialiased">
    <div class="flex h-full flex-col">
        <header class="flex items-center gap-2 border-b border-term-border px-1">
            <a href="/"
                class="px-1 text-term-accent hover:bg-term-sel-bg hover:text-term-sel-fg focus-visible:bg-term-sel-bg focus-visible:text-term-sel-fg focus-visible:outline-none">
                [ {{ config('app.name', 'Laravel') }} ]
            </a>
            <span aria-hidden="true" class="text-term-border">─</span>
            <p class="min-w-0 flex-1 truncate text-term-cyan">{{ request()->user()?->name }}</p>
            <nav aria-label="Основное меню" class="flex items-center gap-1">
                @auth
                    <x-term.button href="{{ route('user.chats.list', request()->user()) }}">Чаты</x-term.button>
                    <form action="{{ route('logout') }}" method="post">
                        @csrf
                        <x-term.button type="submit" danger>Выйти</x-term.button>
                    </form>
                @else
                    <x-term.button href="{{ route('login.index') }}">Вход</x-term.button>
                    <x-term.button href="{{ route('register.index') }}">Регистрация</x-term.button>
                @endauth
            </nav>
        </header>

        <main class="flex min-h-0 flex-1 flex-col p-2 pt-4">
            <x-term.window tag="h1" class="flex min-h-0 flex-1 flex-col">
                <x-slot:title>@yield('title')</x-slot:title>

                <div
                    class="flex min-h-0 flex-1 flex-col overflow-y-auto pt-1 [scrollbar-color:var(--color-term-border)_var(--color-term-bg)] [scrollbar-width:thin] [&::-webkit-scrollbar-thumb]:bg-term-border [&::-webkit-scrollbar-track]:bg-term-bg [&::-webkit-scrollbar]:w-2">
                    @yield('content')
                </div>
            </x-term.window>
        </main>

        <x-term.statusbar>
            <span><kbd>Tab</kbd> Навигация</span>
            <span><kbd>Enter</kbd> Выбрать / Отправить</span>
            <span class="ml-auto hidden sm:inline">{{ config('app.name', 'Laravel') }}</span>
        </x-term.statusbar>
    </div>
</body>

</html>
