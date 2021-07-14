<?php

namespace Tests\Feature;

use App\Models\Comment;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CanLikeCommentTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function guests_users_cant_not_like_comments()
    {
        $comment = Comment::factory()->create();

        $response = $this->postJson(route('comments.likes.store', $comment));

        $response->assertStatus(401);
    }

    /**
     * @test
     *
     * @return void
     */
    public function an_authenticated_user_can_like_comments()
    {
        $this->withoutExceptionHandling();

        $user = User::factory()->create();
        $comment = Comment::factory()->create();

        $this->actingAs($user)->postJson(route('comments.likes.store', $comment));

        $this->assertDatabaseHas('likes', [
            'user_id'   => $user->id,
            'status_id' => $comment->id
        ]);
    }
}
