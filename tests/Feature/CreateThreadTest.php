<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class CreateThreadTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function guest_may_not_create_thread()
    {
        $this->withExceptionHandling();
        
        $this->get('/threads/create')
            ->assertRedirect('/login');

        $this->post('/threads')
            ->assertRedirect('/login');
    }

    /** @test */
    public function an_authenticated_user_can_create_new_forum_threads()
    {
        $this->signIn();

        $thread = factory('App\Thread')->make();
        
        $response = $this->post('/threads', $thread->toArray());

        $this->get($response->headers->get('Location'))
            ->assertSee($thread->title)
            ->assertSee($thread->body);
    }

    /** @test */
    public function unauthorized_can_not_delete_threads()
    {
        $this->withExceptionHandling();

        $thread = factory('App\Thread')->create();

        $this->delete($thread->path())->assertRedirect('/login');

        $this->signIn();
        $this->delete($thread->path())->assertStatus(403);
    }

    /** @test */
    public function authorized_can_delete_thread()
    {
        $this->signIn();

        $thread = factory('App\Thread')->create(['user_id' => auth()->id()]);
        $reply = factory('App\Reply')->create(['thread_id' => $thread->id ]);

        $response = $this->json('delete', $thread->path());

        $response->assertStatus(204);

        $this->assertDatabaseMissing('threads', ['id' => $thread->id]);

        $this->assertDatabaseMissing('replies', ['id' => $reply->id]);
        $this->assertDatabaseMissing('activities', [
            'subject_id' => $thread->id,
            'subject_type' => get_class($thread)
        ]);

        $this->assertDatabaseMissing('activities', [
            'subject_id' => $reply->id,
            'subject_type' => get_class($reply)
        ]);
    }

    /** @test */
    function a_thread_require_a_title()
    {
        $this->publishThread(['title' => null])
            ->assertSessionHasErrors('title');
    }

    /** @test */
    function a_thread_require_a_body()
    {
        $this->publishThread(['body' => null])
            ->assertSessionHasErrors('body');
    }

    /** @test */
    function a_thread_require_a_valid_channel()
    {
        $this->publishThread(['channel_id' => 999])
            ->assertSessionHasErrors('channel_id');

        $this->publishThread(['channel_id' => null])
            ->assertSessionHasErrors('channel_id');
    }

    public function publishThread(array $overrides = [])
    {
        $this->withExceptionHandling()->signIn();

        $thread = factory('App\Thread')->make($overrides);

        return $this->post('/threads', $thread->toArray());
    }
}
