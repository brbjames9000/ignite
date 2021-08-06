<?php

namespace App\Models;

use App\Http\Traits\LikableTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Reply extends Model
{
    use HasFactory;
    use LikableTrait;

    /**
     * Mass assignable attributes.
     *
     * @var array
     */
    protected $fillable = [
        'body',
        'user_id',
        'thread_id',
    ];

    /**
     *Reply belongs to a user
     *
     *  @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
