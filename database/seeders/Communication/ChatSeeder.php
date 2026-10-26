<?php

namespace Database\Seeders\Communication;

use App\Models\User;
use App\Models\Communication\Chat;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ChatSeeder extends Seeder
{

    private $instance = [];

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->createChats();
    }

    private function createChats()
    {
        $userIds = User::pluck('id')->values();
        $total = $userIds->count();

        if ($total < 3) {
            $this->command->warn('Нужно минимум 3 пользователя');
            return;
        }

        foreach ($userIds as $i => $ownerId) {
            for ($h = 0; $h < 3; $h++) {
                $chat = Chat::create([
                    'name' => fake('ru')->realText(30),
                    'owner_id' => $ownerId,
                ]);

                $memberIds = [
                    $ownerId,
                    $userIds[($i + $h + 1) % $total]
                ];

                $chat->users()->syncWithoutDetaching(array_unique($memberIds));
            }
        }
        return;
    }
}
