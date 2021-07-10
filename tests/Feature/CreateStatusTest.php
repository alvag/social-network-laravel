<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CreateStatusTest extends TestCase
{

    use RefreshDatabase;

    /** @test */
    public function an_authenticated_user_can_create_statuses()
    {
        $this->withoutExceptionHandling();

        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->post(route('statuses.store'), [
            'body' => 'Mi primer estado'
        ]);

        $response->assertJson([
            'body' => 'Mi primer estado'
        ]);

        $this->assertDatabaseHas('statuses', [
            'user_id' => $user->id,
            'body'    => 'Mi primer estado'
        ]);
    }

    /** @test */
    function guests_users_cant_not_create_statuses()
    {
//        $this->withoutExceptionHandling();

        $response = $this->post(route('statuses.store'), [
            'body' => 'Mi primer estado'
        ]);

        dd();

        $response->assertRedirect('login');
    }
}
