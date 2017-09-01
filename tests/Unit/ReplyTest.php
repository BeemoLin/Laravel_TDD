<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\Models\Reply;
use App\Models\User;

class ReplyTest extends TestCase
{
	use DatabaseMigrations;
    
    /** @test **/
    public function it_has_an_owner()
    {
    	$reply = create(Reply::class);

    	$this->assertInstanceOf(User::class, $reply->owner);
    }
}
