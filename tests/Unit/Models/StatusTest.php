<?php

namespace Tests\Unit\Models;

use App\Models\Comment;
use App\Models\Like;
use App\Models\Status;
use App\Models\User;

//use PHPUnit\Framework\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class StatusTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     *
     * @return void
     */
    public function a_status_belongs_to_a_user()
    {
        $status = Status::factory()->create();

        $this->assertInstanceOf(User::class, $status->user);
    }

    /** @test */
    function a_status_has_many_likes()
    {
        $status = Status::factory()->create();
        Like::factory()->create(['status_id' => $status->id]);

        $this->assertInstanceOf(Like::class, $status->likes->first());
    }

    /** @test */
    function a_status_can_be_liked_and_unliked()
    {
        $status = Status::factory()->create();
        $user = User::factory()->create();

        $this->actingAs($user);

        $status->like();
        $this->assertEquals(1, $status->fresh()->likes->count());

        $status->unlike();
        $this->assertEquals(0, $status->refresh()->likes->count());
    }

    /** @test */
    function a_status_can_be_liked_once()
    {
        $status = Status::factory()->create();
        $user = User::factory()->create();

        $this->actingAs($user);

        $status->like();
        $this->assertEquals(1, $status->likes->count());

        $status->like();
        $this->assertEquals(1, $status->fresh()->likes->count());
    }

    /** @test */
    function a_status_knows_if_it_has_been_liked()
    {
        $status = Status::factory()->create();

        $this->assertFalse($status->isLiked());

        $user = User::factory()->create();

        $this->actingAs($user);

        $this->assertFalse($status->isLiked());

        $status->like();

        $this->assertTrue($status->isLiked());
    }

    /** @test */
    function a_status_knows_how_many_likes_it_has()
    {
        $status = Status::factory()->create();

        $this->assertEquals(0, $status->likesCount());

        Like::factory(2)->create(['status_id' => $status->id]);

        $this->assertEquals(2, $status->likesCount());
    }

    /** @test */
    function a_status_has_many_comments()
    {
        $status = Status::factory()->create();
        Comment::factory()->create(['status_id' => $status->id]);

        $this->assertInstanceOf(Comment::class, $status->comments->first());
    }
}
