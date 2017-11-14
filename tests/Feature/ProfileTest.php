<?php

namespace Tests\Feature;

use Faker\Factory;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ProfileTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function user_has_a_profile()
    {
        $user = Factory('App\User')->create();

        $this->get('profiles/' . $user->name)
            ->assertSee($user->name);
    }

    /** @test */
    public function profile_display_all_thread_of_this_user()
    {
        $user = Factory('App\User')->create();

        $thread = Factory('App\Thread')->create(['user_id' => $user->id]);

        $this->get('profiles/' . $user->name)
            ->assertSee($thread->title)
            ->assertSee($thread->body);
    }
}
