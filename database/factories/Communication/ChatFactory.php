<?php

namespace Database\Factories\Communication;

use App\Models\User;
use App\Models\Communication\Chat;
use Illuminate\Database\Eloquent\Factories\Factory;
use Override;

/**
 * @extends Factory<Chat>
 */
class ChatFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'owner_id' => User::inRandomOrder()->value('id'),
            'name' => fake('ru')->words(3, true),
        ];
    }

    #[Override]
    public function configure()
    {
        return $this->afterCreating(function (Chat $chat) {
            $chat->users()->syncWithoutDetaching($chat->owner_id);
        });
    }
}
