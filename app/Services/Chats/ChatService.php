<?php

namespace App\Services\Chats;

use App\Models\User;
use App\Models\Communication\{Chat, Message};
use App\Repositories\Chats\{ChatRepository, MessageRepository, ParticipantRepository};
use Illuminate\Support\Collection;

class ChatService
{
    /**
     * @param ChatRepository $chat
     * @param MessageRepository $message
     * @param ParticipantRepository $participant
     */
    public function __construct(
        private ChatRepository $chat,
        private MessageRepository $message,
        private ParticipantRepository $participant
    ) {}

    /**
     * @param User $user
     * @return Collection
     */
    public function getChatList(User $user): Collection
    {
        $chats = $this->chat->getCollections($user->id);
        $chatIds = $chats->pluck('id')->all();

        $participants = $this->participant->getParticipants($chatIds);
        $lastMessage = $this->message->getLastMessage($chatIds);

        return $chats->map(
            fn($chat) => collect([
                'chat' => $chat,
                'message' => $lastMessage->get($chat->id),
                'participants' => $participants->get($chat->id)
            ])
        );
    }
}
