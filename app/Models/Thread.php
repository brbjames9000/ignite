<?php

namespace App\Models;

use App\Http\Traits\LikableTrait;
use Emberfuse\Blaze\Models\Traits\Directable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use phpDocumentor\Reflection\Utils;

class Thread extends Model
{
    use HasFactory;
    use Directable;
    use LikableTrait;

    /**
     * Mass assignable attributes.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'body',
        'user_id',
        'channel_id',
    ];

    /**
     *Thread belongs to a user.
     *
     *  @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     *Thread belongs to a channel.
     *
     *  @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function channel(): BelongsTo
    {
        return $this->belongsTo(Channel::class);
    }

    /**
     * Replies which belongs to this thread.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function replies(): HasMany
    {
        return $this->hasMany(Reply::class);
    }

    /**
     * @param $query
     * @param $filters
     *
     * @return mixed
     */
    public function scopeFilter($query, $filters)
    {
        return $filters->apply($query);
    }
}
