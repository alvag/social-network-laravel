<?php

namespace Tests\Unit\Http\Resources;

use App\Http\Resources\CommentResource;
use App\Models\Comment;
use Illuminate\Foundation\Testing\RefreshDatabase;

//use PHPUnit\Framework\TestCase;
use Tests\TestCase;

class CommentResourceTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     *
     * @return void
     */
    public function a_comment_resources_must_have_the_necessary_fields()
    {
        $comment = Comment::factory()->create();

        $commentResource = CommentResource::make($comment)->resolve();

        $this->assertEquals($comment->body, $commentResource['body']);

//        $this->assertArrayHasKey('body', $statusResource);
//        $this->assertArrayHasKey('user_name', $statusResource);
//        $this->assertArrayHasKey('user_avatar', $statusResource);
//        $this->assertArrayHasKey('ago', $statusResource);
    }
}
