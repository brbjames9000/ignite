<?php

namespace App\Http\Controllers;

use App\Models\Reply;

class ReplyLikesController extends Controller
{
    /**
     * Create likes and unlikes for threads.
     *
     * @param \App\Models\Reply $reply
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Reply $reply)
    {
        $reply->liked();

        return response()->json($reply->likes);
    }
}
