<?php

namespace Database\Factories\Communication;

use App\Models\User;
use App\Models\Communication\{Chat, Message};
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Message>
 */
class MessageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $chatIds = Chat::pluck('id');
        $userIds = User::pluck('id')->limit(20);
        return [
            'chat_id' => $chatIds->random(),
            'sender_id' => $userIds->random(),
            'body' => fake('ru')->realText(),
            'is_hidden' => false
        ];
    }
}
