<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->comment('Пользователи');
            $table->id();
            $table->string('name')->comment('Не уникальное имя. Не стал делать полноценное ФИО');
            $table->string('email')->unique()->comment('Уникальный email');
            $table->timestamp('email_verified_at')->nullable()->comment('Проверка верификации. В dev режиме не обязательна');
            $table->string('password')->comment('Хешированный пароль');
            $table->rememberToken()->comment('Токен постоянного подключения');
            $table->timestampsTz();
            $table->softDeletesTz();

            $table->index('email');
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->comment('Смена пароля');
            $table->string('email')->primary();
            $table->string('token');
            $table->timestampTz('created_at')->nullable();
        });

        Schema::create('user_presence', function (Blueprint $table) {
            $table->comment('Статус пользователя');
            $table->id();
            $table->foreignId('user_id')->constrained('users', 'id');
            $table->boolean('is_online')->default(false)->comment('Статус для показа нахождения пользователя в сети');
            $table->timestampsTz('last_seen_at')->comment('Фиксация последнего времени пребывания в сети');
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->comment('Сессия пользователя');
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
