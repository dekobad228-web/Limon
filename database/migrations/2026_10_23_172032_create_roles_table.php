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

        // Роли по умолчанию: admin, customer
        // Остальные роли создаёт админ в админ панели

        Schema::create('roles', function (Blueprint $table) {
            $table->comment('Роли пользователей');
            $table->id();
            $table->string('name')->unique()->comment('Уникальное название роли');
            $table->text('description')->nullable()->comment('необязательное описание');
            $table->timestampsTz();
            $table->softDeletesTz();

            $table->index('name');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('roles');
    }
};
