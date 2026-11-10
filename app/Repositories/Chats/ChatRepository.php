<?php

namespace App\Repositories\Chats;

use App\Contracts\RepositoryInterface;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use App\DTO\Chats\ChatData;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ChatRepository implements RepositoryInterface
{
    /**
     * @param int $chat_id
     * @return ChatData
     */
    public function findById(int $chat_id): ChatData
    {
        $chat = DB::selectOne('
            select * from chats c
            where c.id = ?
            and c.deleted_at is null
        ', [$chat_id]);

        if ($chat === null) {
            throw new ModelNotFoundException('Chat not found');
        }

        return ChatData::createData($chat);
    }

    /**
     * @param int $user_id
     * @param int $limit (default: 100)
     * @param $offset (default: 0)
     * @return Collection
     */
    public function getCollections(int $user_id, int $limit = 100, int $offset = 0): Collection
    {
        return collect(DB::select('
            select * from chats c
            where c.owner_id = ?
            and c.deleted_at is null
            order by c.updated_at desc
            limit ? offset ?
        ', [$user_id, $limit, $offset]))
            ->map(fn($chat) => ChatData::createData($chat));
    }

    public function create()
    {
        return;
    }

    public function update()
    {
        return;
    }

    public function softDelete()
    {
        return;
    }

    public function delete()
    {
        return;
    }
}
