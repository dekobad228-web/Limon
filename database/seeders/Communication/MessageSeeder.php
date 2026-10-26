<?php

namespace Database\Seeders\Communication;

use App\Models\Communication\{Chat, Message};
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MessageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $chats = Chat::with('users:id')->orderBy('id')->limit(63)->get();
        $count = 20;

        foreach ($chats as $chat) {
            $usersIds = $chat->users->pluck('id');

            if ($usersIds->isEmpty()) {
                $this->command->error('Пользователи в чате не найдены');
            }

            for ($i = 0; $i < $count; $i++) {
                Message::create([
                    'chat_id' => $chat->id,
                    'sender_id' => $usersIds->random(),
                    'body' => fake('ru')->realTextBetween(100, 200),
                    'is_hidden' => false
                ]);
            }
        }
    }
}
