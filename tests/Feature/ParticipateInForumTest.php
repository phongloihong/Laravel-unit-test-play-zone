<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ParticipateInForumTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function unauthenticated_user_may_not_add_replies()
    {
        $this->withExceptionHandling()->post('threads/asd/1/replies', [])
            ->assertRedirect('/login');
    }

    /** @test */
    public function an_authenticated_user_may_participate_in_fortum_threads()
    {
        //create and authenticate user
        $this->signIn();

        $thread = factory('App\Thread')->create();
        $reply = factory('App\Reply')->make();

        $this->post($thread->path() . '/replies', $reply->toArray());

        $this->get($thread->path())
            ->assertSee($reply->body);
    }

    /** @test */
    public function a_reply_require_a_body()
    {
        $this->withExceptionHandling()->signIn();

        $thread = factory('App\Thread')->create();
        $reply = factory('App\Reply')->make(['body' => null]);

        $this->post($thread->path() . '/replies', $reply->toArray())
            ->assertSessionHasErrors('body');
    }

    /** @test */
    public function unauthorized_user_can_not_delete_replies()
    {
        $this->withExceptionHandling();

        $reply = factory('App\Reply')->create();

        $this->delete("replies/{$reply->id}")
            ->assertRedirect('login');
    }

    /** @test */
    public function authorized_user_can_delete_replies()
    {
        $this->signin();

        $reply = factory('App\Reply')->create(['user_id' => auth()->id()]);

        $this->delete("replies/{$reply->id}");
        $this->assertDatabaseMissing('replies', ['id' => $reply->id]);
    }

    /** @test */
    public function authorized_user_can_update_replies()
    {
        $this->signin();

        $reply = factory('App\Reply')->create(['user_id' => auth()->id()]);

        $body = 'This body is updated';
        $this->patch("replies/{$reply->id}", [
            'body' => $body
        ]);

        $this->assertDatabaseHas('replies', [
            'id' => $reply->id,
            'body' => $body
        ]);
    }

    /** @test */
    public function unauthortized_user_can_not_update_replies()
    {
        $this->withExceptionHandling();

        $reply = factory('App\Reply')->create();

        $this->patch("replies/{$reply->id}", [
            'body' => 'This body is updated'
        ])->assertRedirect('login');

        $this->signin();

        $this->patch("replies/{$reply->id}", [
            'body' => 'This body is updated'
        ])->assertStatus(403);
    }
}
