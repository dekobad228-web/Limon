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
        Schema::create('messages', function (Blueprint $table) {
            $table->comment('Таблица всех сообщений');
            $table->id();
            $table->foreignId('chat_id')->constrained('chats', 'id')->comment('Связанный чат');
            $table->foreignId('sender_id')->constrained('users', 'id')->comment('Отправитель');
            $table->longText('body')->comment('Пока только текстовые сообщения');
            $table->boolean('is_hidden')->comment('Функция скрыть для себя или для всех. Скорее всего уберу');
            $table->timestampsTz();
            $table->softDeletesTz();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('messages');
    }
};
