<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\Models\Thread;
use App\Models\User;
use App\Models\Channel;
use Illuminate\Database\Eloquent\Collection;

class ThreadTest extends TestCase
{
    use DatabaseMigrations;

    public function setUp()
    {
        parent::setUp();

        $this->thread = create(Thread::class);
    }

    /** @test **/
    public function a_thread_has_replies()
    {
    	$this->assertInstanceOf(Collection::class, $this->thread->replies);
    }

    /** @test **/
    public function a_thread_has_a_creator()
    {
    	$this->assertInstanceOf(User::class, $this->thread->creator);
    }

    /** @test **/
    public function a_thread_can_add_a_reply()
    {
        $this->thread->addReply([
                'body' => 'Foobar',
                'user_id' => 1,
            ]);

        $this->assertCount(1, $this->thread->replies);
    }

    /** @test **/
    public function a_thread_belongs_to_a_channel()
    {

        $thread = create(Thread::class);
        $this->assertInstanceOf(Channel::class, $thread->channel);
    }

    /** @test **/
    public function a_thread_can_make_a_string_path()
    {
        $thread = create(Thread::class);
        $this->assertEquals('/threads/' . $thread->channel->slug . '/' . $thread->id, $thread->path());
    }
}
