<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserTest extends TestCase
{
    use refreshDatabase;
    /** @test */
    public function a_user_can_be_created()
    {
        $this->withoutExceptionHandling();
        $response = $this->post('/create', [
            'name' => 'teste',
            'email' => 'teste@teste.com',
            'password' => '123456'
        ]);

        $this->assertDatabaseHas('users',[
            'email' => 'teste@teste.com'
        ]);
    }
}
