<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\Models\Reply;
use App\Models\Thread;
use App\Models\User;

class ParticipateInDemoTest extends TestCase
{
    use DatabaseMigrations;

    /** @test **/
    public function unauthenticated_users_may_not_add_replies()
    {
        $this->expectException(AuthenticationException::class);
        
    	$this->post('/threads/some-channel/1/replies', []);
    }

	/** @test **/
    public function an_anthenticated_user_may_participate_in_demo_threads()
    {
        $this->signIn();
 
        $thread = create(Thread::class);
 
        $reply = make(Reply::class);
 
        $this->post($thread->path() . '/replies', $reply->toArray());
 
        $this->get($thread->path())->assertSee($reply->body);
    }
}
