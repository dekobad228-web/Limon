<?php

namespace App\Providers;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;
use CodecDecodec\CodecDecodec;
use CodecDecodec\FF1\Enums\{Aes, Radix};
use App\Models\User;
use App\Models\Communication\Chat;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $key = base64_decode(config('app.codec_key'));

        app()->singleton(CodecDecodec::class);

        app()->singleton('codec.user', function (Application $app) use ($key) {
            return $app->make(CodecDecodec::class)->ff1(
                key: $key,
                tweak: 'user',
                aes: Aes::AES_256_CBC,
                radix: Radix::Decimal,
                length: 12
            );
        });

        app()->singleton('codec.chat', function (Application $app) use ($key) {
            return $app->make(CodecDecodec::class)->ff1(
                key: $key,
                tweak: 'chat',
                aes: Aes::AES_256_CBC,
                radix: Radix::AlphanumericLower,
                length: 12
            );
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Route::model('user', User::class);
        Route::model('chat', Chat::class);
    }
}
