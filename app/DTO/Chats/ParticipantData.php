<?php

namespace App\DTO\Chats;

use App\Contracts\DataInterface;
use Illuminate\Support\{Carbon, Collection};

final readonly class ParticipantData implements DataInterface
{

    /**
     * @param int $id User id
     * @param string $name User name
     * @param Carbon $created_at User creation date and time
     * @param ?Carbon $updated_at User last update date and time 
     * @param ?Carbon $deleted_at User deletion date and time
     */
    public function __construct(
        public int $id,
        public string $name,
        public Carbon $created_at,
        public ?Carbon $updated_at = null,
        public ?Carbon $deleted_at = null
    ) {}

    /**
     * Array of participant variables
     * 
     * @return array
     */
    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'deleted_at' => $this->deleted_at
        ];
    }

    /**
     * Collection of participant variables
     * 
     * @return Collection
     */
    public function toCollection(): Collection
    {
        return collect($this->toArray());
    }

    /**
     * Creates a DTO from a User model
     * 
     * @param object $user 
     * @return self
     */
    public static function createData(object $user): self
    {
        return new self(
            id: $user->id,
            name: $user->name,
            created_at: Carbon::parse($user->created_at),
            updated_at: ($user->updated_at) ? Carbon::parse($user->updated_at) : null,
            deleted_at: ($user->deleted_at) ? Carbon::parse($user->deleted_at) : null
        );
    }
}
