@extends('index')

@section('title', 'Регистрация')

@section('content')
    <form action="{{ route('register.store') }}" method="POST"
        class="mx-auto max-w-md space-y-5 rounded-xl border border-gray-200 bg-white p-8 shadow-sm">
        @csrf

        <h1 class="text-2xl font-bold text-gray-900">Регистрация</h1>

        <div>
            <label for="name" class="mb-1.5 block text-sm font-medium text-gray-700">
                Имя
            </label>
            <input type="text" name="name" id="name" value="{{ old('name') }}" placeholder="Введите Имя" required maxlength="100"
                class="w-full rounded-lg border border-gray-300 px-3 py-2.5 text-gray-900 outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-100">
            @error('name')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="email" class="mb-1.5 block text-sm font-medium text-gray-700">
                Email
            </label>
            <input type="email" name="email" id="email" placeholder="Введите Email" value="{{ old('email') }}" required maxlength="100"
                class="w-full rounded-lg border border-gray-300 px-3 py-2.5 text-gray-900 outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-100">
            @error('email')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="password" class="mb-1.5 block text-sm font-medium text-gray-700">
                Пароль
            </label>
            <input type="password" name="password" id="password" placeholder="Введите пароль" required autocomplete="new-password"
                class="w-full rounded-lg border border-gray-300 px-3 py-2.5 text-gray-900 outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-100">
            @error('password')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="password_confirmation" class="mb-1.5 block text-sm font-medium text-gray-700">
                Подтверждение пароля
            </label>
            <input type="password" name="password_confirmation" id="password_confirmation" required placeholder="Повторите пароль"
                autocomplete="new-password"
                class="w-full rounded-lg border border-gray-300 px-3 py-2.5 text-gray-900 outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-100">
        </div>

        <button type="submit"
            class="w-full rounded-lg bg-blue-600 px-4 py-2.5 font-medium text-white transition hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
            Зарегистрироваться
        </button>

        <p class="text-center text-sm text-gray-600">
            Уже есть аккаунт?
            <a href="{{ route('login.index') }}" class="font-medium text-blue-600 hover:text-blue-700">
                Войти
            </a>
        </p>
    </form>
@endsection
