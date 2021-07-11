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
        // $this->withoutExceptionHandling();

        $response = $this->post(route('statuses.store'), [
            'body' => 'Mi primer estado'
        ]);

        $response->assertRedirect('login');
    }

    /** @test */
    function a_status_require_a_body()
    {
        //$this->withoutExceptionHandling();

        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->postJson(route('statuses.store'), ['body' => '']);

        $response->assertStatus(422);

        $response->assertJsonStructure([
            'message', 'errors' => ['body']
        ]);
    }

    /** @test */
    function a_status_body_requires_a_minimum_length()
    {
        // $this->withoutExceptionHandling();

        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->postJson(route('statuses.store'), ['body' => 'abcd']);

        $response->assertStatus(422);

        $response->assertJsonStructure([
            'message', 'errors' => ['body']
        ]);
    }
}
