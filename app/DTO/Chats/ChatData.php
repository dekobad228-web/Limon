<?php

namespace App\DTO\Chats;

use App\Contracts\DataInterface;
use Illuminate\Support\{Carbon, Collection};

final readonly class ChatData implements DataInterface
{

    /**
     * @param int $id Chat id
     * @param int $owner_id Chat creator
     * @param string $name Chat name
     * @param Carbon $created_at Chat creation date and time
     * @param ?Carbon $updated_at Chat last update date and time 
     * @param ?Carbon $deleted_at Chat deletion date and time
     */

    public function __construct(
        public int $id,
        public int $owner_id,
        public string $name,
        public Carbon $created_at,
        public ?Carbon $updated_at = null,
        public ?Carbon $deleted_at = null,
    ) {}

    /**
     * Array of chat variables
     * 
     * @return array
     */
    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'owner_id' => $this->owner_id,
            'name' => $this->name,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'deleted_at' => $this->deleted_at
        ];
    }

    /**
     * Collection of chat variables
     * 
     * @return Collection
     */
    public function toCollection(): Collection
    {
        return collect($this->toArray());
    }

    /**
     * Creates a DTO from a Chat model
     * 
     * @param object $chat 
     * @return self
     */
    public static function createData(object $chat): self
    {
        return new self(
            id: $chat->id,
            owner_id: $chat->owner_id,
            name: $chat->name,
            created_at: Carbon::parse($chat->created_at),
            updated_at: ($chat->updated_at) ? Carbon::parse($chat->updated_at) : null,
            deleted_at: ($chat->deleted_at) ? Carbon::parse($chat->deleted_at) : null
        );
    }
}
