<?php

namespace App\Http\Controllers;

use App\Models\Thread;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ThreadLikesController extends Controller
{
    /**
     * Create likes and unlikes for threads.
     *
     * @param \App\Models\Thread $thread
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Thread $thread)
    {
        $thread->liked();

        return response()->json($thread->likes);
    }
}
