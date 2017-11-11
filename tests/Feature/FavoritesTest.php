<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class FavoritesTest extends TestCase
{
	use DatabaseMigrations;

	/** @test */
	public function guest_can_not_favorite_anything()
    {
        $this->withExceptionHandling();
        $this->post('replies/1/favorites')
            ->assertRedirect('/login');
    }

    /** @test */
    public function an_authenticated_user_can_favorite_any_reply()
    {
        $this->signIn();

        $reply = factory('App\Reply')->create();

    	$this->post('replies/' . $reply->id . '/favorites');

    	$this->assertCount(1, $reply->favorites);
    }

    /** @test */
    public function an_authenticated_user_can_favorited_thread_one_time()
    {
        $this->signIn();

        $reply = factory('App\Reply')->create();

        $this->post('replies/' . $reply->id . '/favorites');
        $this->post('replies/' . $reply->id . '/favorites');

        $this->assertCount(1, $reply->favorites);
    }
}