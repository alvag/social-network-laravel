<?php

namespace Tests\Unit\Http\Resources;

use App\Http\Resources\StatusResource;
use App\Models\Status;
use Illuminate\Foundation\Testing\RefreshDatabase;

//use PHPUnit\Framework\TestCase;
use Tests\TestCase;

class StatusResourceTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     *
     * @return void
     */
    public function a_status_resources_must_have_the_necessary_fields()
    {
        $status = Status::factory()->create();

        $statusResource = StatusResource::make($status)->resolve();

        $this->assertEquals($status->body, $statusResource['body']);
        $this->assertEquals($status->user->name, $statusResource['user_name']);
        $this->assertEquals('https://www.irishrsa.ie/wp-content/uploads/2017/03/default-avatar-300x300.png', $statusResource['user_avatar']);
        $this->assertEquals($status->created_at->diffForHumans(), $statusResource['ago']);

//        $this->assertArrayHasKey('body', $statusResource);
//        $this->assertArrayHasKey('user_name', $statusResource);
//        $this->assertArrayHasKey('user_avatar', $statusResource);
//        $this->assertArrayHasKey('ago', $statusResource);
    }
}
