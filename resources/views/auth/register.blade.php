@extends('index')

@section('title', 'Регистрация')

@section('content')
    <form action="{{ route('register.store') }}" method="POST" class="mx-auto w-full max-w-[60ch] space-y-1 px-1">
        @csrf

        <h2 class="mb-1 uppercase text-term-magenta"># Регистрация</h2>

        <div>
            <div class="flex flex-col sm:flex-row sm:items-baseline sm:gap-2">
                <label for="name" class="shrink-0 text-term-dim sm:w-[22ch]">Имя:</label>
                <x-term.input type="text" name="name" id="name" value="{{ old('name') }}"
                    placeholder="Введите Имя" required maxlength="100" class="flex-1" />
            </div>
            @error('name')
                <p role="alert" class="text-term-red">! {{ $message }}</p>
            @enderror
        </div>

        <div>
            <div class="flex flex-col sm:flex-row sm:items-baseline sm:gap-2">
                <label for="email" class="shrink-0 text-term-dim sm:w-[22ch]">Email:</label>
                <x-term.input type="email" name="email" id="email" placeholder="Введите Email"
                    value="{{ old('email') }}" required maxlength="100" class="flex-1" />
            </div>
            @error('email')
                <p role="alert" class="text-term-red">! {{ $message }}</p>
            @enderror
        </div>

        <div>
            <div class="flex flex-col sm:flex-row sm:items-baseline sm:gap-2">
                <label for="password" class="shrink-0 text-term-dim sm:w-[22ch]">Пароль:</label>
                <x-term.input type="password" name="password" id="password" placeholder="Введите пароль" required
                    autocomplete="new-password" class="flex-1" />
            </div>
            @error('password')
                <p role="alert" class="text-term-red">! {{ $message }}</p>
            @enderror
        </div>

        <div>
            <div class="flex flex-col sm:flex-row sm:items-baseline sm:gap-2">
                <label for="password_confirmation" class="shrink-0 text-term-dim sm:w-[22ch]">Подтверждение пароля:</label>
                <x-term.input type="password" name="password_confirmation" id="password_confirmation" required
                    placeholder="Повторите пароль" autocomplete="new-password" class="flex-1" />
            </div>
        </div>

        <div class="pt-1">
            <x-term.button type="submit">Зарегистрироваться</x-term.button>
        </div>

        <p class="text-term-dim">
            Уже есть аккаунт?
            <a href="{{ route('login.index') }}"
                class="text-term-cyan underline decoration-dotted hover:bg-term-sel-bg hover:text-term-sel-fg focus-visible:bg-term-sel-bg focus-visible:text-term-sel-fg focus-visible:outline-none">
                Войти
            </a>
        </p>
    </form>
@endsection
