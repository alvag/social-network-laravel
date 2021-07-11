<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use Throwable;

class UsersCanCreateStatusesTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     * @test
     * @return void
     * @throws Throwable
     */
    public function users_can_create_statuses()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                ->type('body', 'Mi primer status')
                ->press('#create-status')
                ->assertSee('Mi primer status');
        });
    }
}
