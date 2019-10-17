<?php

namespace Tests\Feature;

use App\User;
use App\Service;
use Tests\TestCase;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class HiringTest extends TestCase
{
    use RefreshDatabase;
    /** @test */
    public function a_user_can_hire_a_service()
    {
        $user = factory(User::class)->create();
        Auth::login($user);
        $service = factory(Service::class)->create();
        $response = $this->post(route('service.hire', $service));
        $this->assertDatabaseHas('service_user',[
            'service_id' => $service->id,
            'user_id' => $user->id,
        ]);
    }
}
