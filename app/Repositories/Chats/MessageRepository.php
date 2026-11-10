<?php

namespace App\Repositories\Chats;

use App\Contracts\RepositoryInterface;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use App\DTO\Chats\MessageData;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class MessageRepository implements RepositoryInterface
{

    /**
     * @param int $message_id
     * @return MessageData
     */
    public function findById(int $message_id): MessageData
    {
        $message = DB::selectOne('
            select * from messages m
            where m.id = ?
            and m.deleted_at is null
        ', [$message_id]);

        if ($message === null) {
            throw new ModelNotFoundException('Message not found');
        }

        return MessageData::createData($message);
    }

    /**
     * @param int $chat_id
     * @param int $limit (default: 100)
     * @param $offset (default: 0)
     * @return Collection
     */
    public function getCollections(int $chat_id, int $limit = 100, int $offset = 0): Collection
    {
        return collect(DB::select('
            select * from messages m 
            where m.chat_id = ? 
            order by created_at desc 
            limit ? offset ?
        ', [$chat_id, $limit, $offset]))->map(fn($message) => MessageData::createData($message));
    }

    public function getLastMessage(int|array $chat_id): Collection
    {
        if ($chat_id === []) {
            return collect();
        }
        $chatIds = is_array($chat_id) ? $chat_id : [$chat_id];

        $values = implode(", ", array_fill(0, count($chatIds), '?'));

        return collect(DB::select("
            select distinct on (m.chat_id) m.*
            from messages m
            where m.chat_id in ($values)
            and m.deleted_at is null
            order by m.chat_id, m.created_at desc, m.id desc
        ", $chatIds))
            ->map(fn($message) => MessageData::createData($message))
            ->keyBy('chat_id');
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
