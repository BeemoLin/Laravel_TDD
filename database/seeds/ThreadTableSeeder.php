<?php

use App\Models\Reply;
use App\Models\Thread;
use Illuminate\Database\Seeder;

class ThreadTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $threads = factory(Thread::class, 50)->create();

        foreach ($threads as $thread) {
        	factory(Reply::class, 10)->create(['thread_id' => $thread->id]);
        }
    }
}
