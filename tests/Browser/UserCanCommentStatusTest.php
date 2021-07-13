<?php

namespace Tests\Browser;

use App\Models\Comment;
use App\Models\Status;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use Throwable;

class UserCanCommentStatusTest extends DuskTestCase
{
    use DatabaseMigrations;

    /**
     * @test
     *
     * @return void
     * @throws Throwable
     */
    public function authenticated_users_can_comment_statuses()
    {
        $status = Status::factory()->create();
        $user = User::factory()->create();

        $this->browse(function (Browser $browser) use ($status, $user) {
            $comment = 'Mi primer comentario';
            $browser->loginAs($user)
                ->visit('/')
                ->waitForText($status->body)
                ->type('comment', $comment)
                ->press('@comment-btn')
                ->waitForText($comment)
                ->assertSee($comment);
        });
    }

    /** @test */
    function users_can_see_all_comments()
    {
        $status = Status::factory()->create();
        $comments = Comment::factory(2)->create(['status_id' => $status->id]);

        $this->browse(function (Browser $browser) use ($status, $comments) {
            $browser->visit('/')
                ->waitForText($status->body)
                ->assertSee($comments->shift()->body)
                ->assertSee($comments->shift()->body);
        });
    }
}
