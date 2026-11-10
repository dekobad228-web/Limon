<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laravel') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-gray-50 text-gray-900 antialiased">
    <header class="border-b border-gray-200 bg-white">
        <div class="mx-auto flex max-w-6xl items-center justify-between px-5 py-4 sm:px-6">
            <div class="flex items-center gap-2 sm:gap-3">
                <a href="/" class="text-xl font-bold tracking-tight text-gray-900 transition hover:text-blue-600">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <h1>{{ request()->user()->name }}</h1>
            </div>
            <nav class="flex items-center gap-2 sm:gap-3">
                @auth
                    <a href="{{ route('user.chats.list', request()->user()) }}"
                        class="rounded-lg px-3 py-2 text-sm font-medium text-gray-600 transition hover:bg-gray-100 hover:text-gray-900 sm:px-4">
                        Чаты
                    </a>
                    <form action="{{ route('logout') }}" method="post">
                        @csrf
                        <button type="submit">Выйти</button>
                    </form>
                @else
                    <a href="{{ route('login.index') }}"
                        class="rounded-lg px-3 py-2 text-sm font-medium text-gray-600 transition hover:bg-gray-100 hover:text-gray-900 sm:px-4">
                        Вход
                    </a>

                    <a href="{{ route('register.index') }}"
                        class="rounded-lg bg-blue-600 px-3 py-2 text-sm font-medium text-white shadow-sm transition hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 sm:px-4">
                        Регистрация
                    </a>
                @endauth
            </nav>
        </div>
    </header>

    <main class="mx-auto w-full max-w-6xl px-5 py-8 sm:px-6 sm:py-10">
        @hasSection('title')
            <div class="mb-8">
                <h1 class="text-2xl font-bold tracking-tight text-gray-900 sm:text-3xl">
                    @yield('title')
                </h1>
            </div>
        @endif

        <div class="min-w-0">
            @yield('content')
        </div>
    </main>
</body>

</html>
