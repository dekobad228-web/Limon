<?php

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Communication\Chat;
use Illuminate\Support\Facades\{Auth, Route};
use App\Http\Controllers\User\StartPageController;
use App\Http\Controllers\User\Chats\{ChatListController, ChatDetailController};
use App\Http\Controllers\User\Albums\AlbumListController;

Route::get('/', function () {
    if (Auth::check()) {
        return redirect()->route('user.start', Auth::user());
    }
    return view('index');
});

Route::middleware('auth')->prefix('/user:{user}')->name('user.')->group(function () {
    //Стартовая страница пользователя
    Route::get('/', [StartPageController::class, 'index'])->name('start');

    //Чаты
    Route::prefix('/chats')->name('chats.')->group(function () {
        Route::get('/', [ChatListController::class, 'index'])->name('list');

        Route::prefix('/chat:{chat}')->name('detail.')->group(function () {
            Route::get('/', [ChatDetailController::class, 'index'])->name('index');
            Route::post('/', [ChatDetailController::class, 'store'])->name('store');
        });
    });

    //Альбомы
    Route::prefix('/albums')->name('albums.')->group(function () {
        Route::get('/', [AlbumListController::class, 'index'])->name('list');
    });

    //Профиль
    Route::prefix('/profile')->name('profile.')->group(function () {});
});
