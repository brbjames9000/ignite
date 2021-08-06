<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    use HasFactory;

    /**
     * Mass assignable attributes.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'liked_resource_id',
        'liked_resource_type',
    ];

    public function like()
    {
        return $this->morphMany(Like::class, 'likable');
    }
}
