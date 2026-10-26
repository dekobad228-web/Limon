<?php

namespace App\Models\Communication;

use App\Models\User;
use Illuminate\Database\Eloquent\{Model, SoftDeletes};
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\{BelongsToMany, BelongsTo};
use Override;

/**
 * @method static \Database\Factories\Communication\MessageFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Message newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Message newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Message query()
 * @mixin \Eloquent
 */
class Message extends Model
{
    /** @use HasFactory<\Database\Factories\Communication\MessageFactory> */
    use HasFactory, SoftDeletes;

    protected $table = 'messages';

    protected $fillable = [
        'chat_id',
        'sender_id',
        'body',
        'is_hidden'
    ];

    public function chat(): BelongsTo
    {
        return $this->belongsTo(Chat::class, 'chat_id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'sender_id');
    }
}
