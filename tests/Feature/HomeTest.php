<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class HomeTest extends TestCase
{
    /** @test */
    public function home_working()
    {
        $this->withoutExceptionHandling();
        $user = factory(User::class)->make();
        Auth::login($user);
        $response = $this->get('/');
        $response->assertViewIs('home.welcome');
        $response->assertViewHas('user');
    }
}
