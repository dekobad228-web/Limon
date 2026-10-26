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
        Schema::create('chats', function (Blueprint $table) {
            $table->comment('Чаты пользователей');
            $table->id();
            $table->foreignId('owner_id')->constrained('users')->default(null);
            $table->string('name', 100)->comment('Уникальное название чата. Создана с расчётом на групповые чаты');
            $table->comment('Создатель чата. Нужна только для информации')->foreignId('owner_id')->constrained('users', 'id');
            $table->timestampsTz();
            $table->softDeletesTz();

            $table->index('name');
        });

        Schema::create('chat_members', function (Blueprint $table) {
            $table->comment('Связка чатов и пользователей');
            $table->id();
            $table->foreignId('user_id')->constrained('users', 'id');
            $table->foreignId('chat_id')->constrained('chats', 'id');
            $table->timestampsTz();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chat_members');
        Schema::dropIfExists('chats');
    }
};
