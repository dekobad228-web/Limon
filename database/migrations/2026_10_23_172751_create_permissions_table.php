<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */

    // Права и роли назначает и создаёт администратор
    
    public function up(): void
    {
        Schema::create('permissions', function (Blueprint $table) {
            $table->comment('Права пользователей');
            $table->id();
            $table->string('name', 100)->unique()->comment('Уникальное название права');
            $table->text('description')->nullable()->comment('Необязательное описание');
            $table->timestamps();

            $table->index('name');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('permissions');
    }
};
