<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\Models\Thread;
use App\Models\Reply;

class ThreadsTest extends TestCase
{
    use DatabaseMigrations;

    public function setUp()
    {
        parent::setUp();
 
        $this->thread = create(Thread::class);
    }

    /** @test **/
    public function a_user_can_view_all_threads()
    {
        $response = $this->get('/threads')->assertSee($this->thread->title);
    }

    /** @test **/
    public function a_user_can_read_a_single_thread()
    {
        $response = $this->get($this->thread->path())->assertSee($this->thread->title);
    }

    /** @test **/
    public function a_user_can_read_replies_that_are_associated_with_a_thread()
    {
        $reply = create(Reply::class, ['thread_id' => $this->thread->id]);

        $this->get($this->thread->path())->assertSee($reply->body);
    }
}
