@extends('index')

@section('title', 'Войти в систему')

@section('content')
    <form action="{{ route('login.store') }}" method="POST" class="mx-auto w-full max-w-[60ch] space-y-1 px-1">
        @csrf

        <h2 class="mb-1 uppercase text-term-magenta"># Вход</h2>

        <div>
            <div class="flex flex-col sm:flex-row sm:items-baseline sm:gap-2">
                <label for="email" class="shrink-0 text-term-dim sm:w-[22ch]">Email:</label>
                <x-term.input type="email" name="email" id="email" value="{{ old('email', session('email')) }}"
                    required maxlength="100" placeholder="Введите Email" autocomplete="email" class="flex-1" />
            </div>
            @error('email')
                <p role="alert" class="text-term-red">! {{ $message }}</p>
            @enderror
        </div>

        <div>
            <div class="flex flex-col sm:flex-row sm:items-baseline sm:gap-2">
                <label for="password" class="shrink-0 text-term-dim sm:w-[22ch]">Пароль:</label>
                <x-term.input type="password" name="password" id="password" required placeholder="Введите Пароль"
                    autocomplete="current-password" class="flex-1" />
            </div>
            @error('password')
                <p role="alert" class="text-term-red">! {{ $message }}</p>
            @enderror
        </div>

        <div class="pt-1">
            <x-term.button type="submit">Войти</x-term.button>
        </div>

        <p class="text-term-dim">
            Нет аккаунта?
            <a href="{{ route('register.index') }}"
                class="text-term-cyan underline decoration-dotted hover:bg-term-sel-bg hover:text-term-sel-fg focus-visible:bg-term-sel-bg focus-visible:text-term-sel-fg focus-visible:outline-none">
                Зарегистрироваться
            </a>
        </p>
    </form>
@endsection
