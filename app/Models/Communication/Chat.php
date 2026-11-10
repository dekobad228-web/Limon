<?php

namespace App\Models\Communication;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\{Model, SoftDeletes};
use Illuminate\Database\Eloquent\Relations\{BelongsTo, BelongsToMany, HasMany};
use App\Exceptions\InvalidChatTockenException;

/**
 * @method static \Database\Factories\Communication\ChatFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Chat newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Chat newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Chat query()
 * @mixin \Eloquent
 */

class Chat extends Model
{
    /** @use HasFactory<\Database\Factories\Communication\ChatFactory> */
    use HasFactory, SoftDeletes;

    protected $table = 'chats';
    protected $primaryKey = 'id';
    protected $keyType = 'int';

    protected $fillable = [
        'name',
        'owner_id'
    ];

    protected $casts = [
        'created_at' => 'datetime'
    ];

    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'chat_members', 'chat_id', 'user_id')
            ->withPivot('created_at');
    }

    public function messages(): HasMany
    {
        return $this->hasMany(Message::class, 'chat_id');
    }

    public function getRouteKey()
    {

        return app('codec.chat')->encrypt($this->id);
    }

    public function resolveRouteBinding($value, $field = 'id')
    {

        try {
            $id = intval(app('codec.chat')->decrypt($value));
        } catch (\Throwable $th) {
            throw new InvalidChatTockenException();
        }

        return $this->where('id', $id)->first();
    }
}
