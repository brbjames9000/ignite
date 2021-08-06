<?php

namespace App\Http\Controllers;

use App\Filters\ThreadFilters;
use App\Http\Requests\ThreadRequest;
use App\Models\Channel;
use App\Models\Thread;

class ThreadController extends Controller
{

    /**
     * @param Channel|null $channel
     * @param ThreadFilters $filters
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(?Channel $channel = null, ThreadFilters $filters)
    {
        return response()->json((! is_null($channel)) ? $channel->threads->all() : Thread::filter($filters)->get());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->response('Thread Creation');
    }

    /**
        * Store a newly created resource in storage.
        *
        * @param ThreadRequest $request
        *
        * @return \Illuminate\Http\JsonResponse
        */
    public function store(ThreadRequest $request)
    {
        $thread = Thread::create($request->validated());

        return response()->json($thread, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Channel $channel
     * @param \App\Models\Thread  $thread
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Channel $channel, Thread $thread)
    {
        return response()->json($thread);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Thread $thread
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Thread $thread)
    {
        $this->response('Thread Edit View');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Thread       $thread
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(ThreadRequest $request, Thread $thread)
    {
        $this->authorize('update', $thread);

        $thread->update($request->validated());

        return response()->json($thread);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Thread $thread
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Thread $thread)
    {
        $this->authorize('update', $thread);

        $thread->delete();

        return response()->json();
    }
}
