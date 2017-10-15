<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ChannelTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function a_channel_has_threads()
    {
    	$channel = factory('App\Channel')->create();
    	$thread = factory('App\Thread')->create(['channel_id' => $channel->id]);

    	$this->assertTrue($channel->threads->contains($thread));
    }
}
