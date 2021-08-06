<?php

namespace Tests\Feature\Like;

use App\Models\Reply;
use App\Models\Thread;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LikesTest extends TestCase
{
    use RefreshDatabase;

    public function testAuthenticatedUserLikesThread()
    {
        $this->signIn();

        $thread = create(Thread::class);

        $this->post('/thread/'.$thread->id.'/likes');

        $this->assertCount(1, $thread->likes);
    }

    public function testAuthenticatedUserLikesReply()
    {
        $this->signIn();

        $reply = create(Reply::class);

        $this->post('/replies/'.$reply->id.'/likes');

        $this->assertCount(1, $reply->likes);
    }

    public function testAuthenticatedUserDisLikesThread()
    {
        $this->signIn();

        $thread = create(Thread::class);

        $this->post('/thread/'.$thread->id.'/likes');

        $this->post('/thread/'.$thread->id.'/likes');

        $this->assertCount(0, $thread->likes);
    }

    public function testAuthenticatedUserDisLikesReply()
    {
        $this->signIn();

        $reply = create(Reply::class);

        $this->post('/replies/'.$reply->id.'/likes');

        $this->post('/replies/'.$reply->id.'/likes');

        $this->assertCount(0, $reply->likes);
    }
}
