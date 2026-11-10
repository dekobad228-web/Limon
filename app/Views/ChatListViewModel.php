<?php

namespace App\Views;

use App\Contracts\ViewModelInterface;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Support\Collection;
use App\DTO\Chats\{ChatData, MessageData, ParticipantData};

class ChatListViewModel implements Arrayable, ViewModelInterface
{
    public function __construct(
        public readonly array $chats,
    ) {}

    public function toArray(): array
    {
        return [
            'chats' => $this->chats
        ];
    }

    public static function make(Collection $collection): ViewModelInterface
    {
        return new self(self::present($collection));
    }

    private static function present(Collection $collection): array
    {
        return $collection->map(fn($row) => [
            'chat' => self::formatChat($row->get('chat')),

            'message' => $row->get('message')
                ? self::formatMessage($row->get('message'))
                : null,

            'participants' => $row->get('participants', collect())
                ->map(fn($participant) => self::formatParticipant($participant))
                ->values()
                ->all()

        ])->values()->all();
    }

    private static function formatChat(ChatData $chat): array
    {
        return [
            'token' => app('codec.chat')->encrypt($chat->id),
            'name' => $chat->name,
            'created_at' => $chat->created_at->format('d.m.Y H:i'),
            'updated_at' => $chat->updated_at?->format('d.m.Y H:i')
        ];
    }

    private static function formatMessage(MessageData $message): array
    {
        return [
            'body' => $message->body,
            'is_hidden' => $message->is_hidden,
            'created_at' => $message->created_at->format('H:i')
        ];
    }

    private static function formatParticipant(ParticipantData $participant): array
    {
        return [
            'token' => app('codec.user')->encrypt($participant->id),
            'name' => $participant->name
        ];
    }
}
