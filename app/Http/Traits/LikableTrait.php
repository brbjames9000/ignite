<?php

namespace App\Http\Traits;

use App\Models\Like;
use Illuminate\Support\Facades\Auth;

trait LikableTrait
{
    /**
     * likable relationship
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function likes()
    {
        return $this->morphMany(Like::class, 'likable');
    }

    /**
     * Create likes if it does not exsists, otherwise remove
     *
     * @return \Illuminate\Database\Eloquent\Model|mixed
     */
    public function liked()
    {
        if (!$this->hasLiked()) {
            return $this->likes()->create(['user_id' => Auth::user()->id]);
        }
        return $this->likes()->where('user_id', Auth::user()->id)->delete();
    }

    /**
     * Checking if Thread/reply has been liked before
     *
     * @return bool
     */
    protected function hasLiked(): bool
    {
        return $this->likes()->where('user_id', Auth::user()->id)->exists();
    }
}
