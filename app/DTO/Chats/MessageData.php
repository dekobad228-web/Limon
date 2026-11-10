<?php

namespace App\DTO\Chats;

use App\Contracts\DataInterface;
use Illuminate\Support\{Carbon, Collection};

final readonly class MessageData implements DataInterface
{
    /**
     * @param int $id Message id
     * @param int $chat_id Chat id
     * @param int $sender_id Sender
     * @param string $body Message text
     * @param bool $is_hidden 
     * @param Carbon $created_at Message creation date and time
     * @param ?Carbon $updated_at Message last update date and time 
     * @param ?Carbon $deleted_at Message deletion date and time
     */
    public function __construct(
        public int $id,
        public int $chat_id,
        public int $sender_id,
        public string $body,
        public bool $is_hidden,
        public Carbon $created_at,
        public ?Carbon $updated_at = null,
        public ?Carbon $deleted_at = null
    ) {}

    /**
     * Array of message variables
     * 
     * @return array
     */
    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'chat_id' => $this->chat_id,
            'sender_id' => $this->sender_id,
            'body' => $this->body,
            'is_hidden' => $this->is_hidden,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'deleted_at' => $this->deleted_at
        ];
    }

    /**
     * Collection of message variables
     * 
     * @return Collection
     */
    public function toCollection(): Collection
    {
        return collect($this->toArray());
    }

    /**
     * Creates a DTO from a Message model
     * 
     * @param object $message 
     * @return self
     */
    public static function createData(object $message): self
    {
        return new self(
            id: $message->id,
            chat_id: $message->chat_id,
            sender_id: $message->sender_id,
            body: $message->body,
            is_hidden: $message->is_hidden,
            created_at: Carbon::parse($message->created_at),
            updated_at: ($message->updated_at) ? Carbon::parse($message->updated_at) : null,
            deleted_at: ($message->deleted_at) ? Carbon::parse($message->deleted_at) : null
        );
    }
}
