<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $count = 20;
        if (User::exists()) {
            $result = $this->command->confirm('Пользователи уже созданы. Создать ещё?', false);

            if (!$result) {
                return;
            }

            $count = $this->command->ask('Введите количество пользователей (По умолчанию 20)', 20);
        }
        User::firstOrCreate(
            [
                'email' => 'deko.bad228@gmail.com'
            ],
            [
                'name' => 'Deko',
                'email' => 'deko.bad228@gmail.com',
                'password' => 123,
                'email_verified_at' => now()
            ]
        );

        User::factory()->count((int) $count)->create();
        $this->command->info("Создано {$count} тестовых пользователей");
    }
}
