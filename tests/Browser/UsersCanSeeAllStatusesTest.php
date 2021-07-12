<?php

namespace Tests\Browser;

use App\Models\Status;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use Throwable;

class UsersCanSeeAllStatusesTest extends DuskTestCase
{
    use DatabaseMigrations;

    /**
     * @test
     * @return void
     * @throws Throwable
     */
    public function users_can_see_all_statuses_on_the_home()
    {
        $statuses = Status::factory(3)->create();

        $this->browse(function (Browser $browser) use ($statuses) {
            $browser->visit('/')
                ->waitForText($statuses->first()->body)
                ->assertSee($statuses->first()->body);

            foreach ($statuses as $status) {
                $browser->assertSee($status->body);
            }
        });
    }
}
