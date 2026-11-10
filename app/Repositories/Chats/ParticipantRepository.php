<?php

namespace App\Repositories\Chats;

use App\Contracts\RepositoryInterface;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use App\DTO\Chats\ParticipantData;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ParticipantRepository implements RepositoryInterface
{

    public function findById(int $id): ParticipantData
    {
        $user = DB::selectOne('
            select u.id, u.name, u.created_at, u.updated_at, u.deleted_at
            from users u
            where u.id = ?
            and u.deleted_at is null
        ', [$id]);

        if ($user === null) {
            throw new ModelNotFoundException('User not found');
        }

        return ParticipantData::createData($user);
    }

    /**
     * @param int|array $chat_id
     * @return Collection
     */
    public function getParticipants(int|array $chat_id): Collection
    {
        if ($chat_id === []) {
            return collect();
        }

        $chatIds = is_array($chat_id) ? $chat_id : [$chat_id];

        $values = implode(", ", array_fill(0, count($chatIds), '?'));

        return collect(DB::select("
            select u.id, u.name, u.email, u.created_at, u.updated_at, u.deleted_at, cm.chat_id 
            from users u
            join chat_members cm on u.id = cm.user_id
            where cm.chat_id in ($values)
            order by u.name asc
        ", $chatIds))->groupBy('chat_id')
            ->map(fn($chat) => $chat->map(fn($user) => ParticipantData::createData($user)));
    }
}
