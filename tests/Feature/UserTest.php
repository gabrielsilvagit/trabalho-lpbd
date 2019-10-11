<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\User;

class UserTest extends TestCase
{
    use refreshDatabase;
    /** @test */
    public function a_user_can_be_created()
    {
        $this->withoutExceptionHandling();
        $response = $this->post('/create/save', $this->data());
        $user = User::all();
        $this->assertCount(1, User::all());
    }
    /** @test */
    public function a_name_is_required()
    {
        $user = $this->data();
        $user['name']="";
        $response = $this->post('/create', $user);
        $this->assertCount(0, User::all());
    }
    /** @test */
    public function an_email_is_required()
    {
        $user = $this->data();
        $user['email']="";
        $response = $this->post('/create', $user);
        $this->assertCount(0, User::all());
    }
    /** @test */
    public function a_password_is_required()
    {
        $user = $this->data();
        $user['password']="";
        $response = $this->post('/create', $user);
        $this->assertCount(0, User::all());
    }
     /** @test */
     public function a_user_can_be_updated()
     {
         $this->withoutExceptionHandling();
         $this->post('/create', $this->data());
         $user = User::first();
         $response = $this->patch('user/'.$user->id, [
             'name' => 'teste2',
             'email' => 'teste2@teste2.com',
             'password' => '654321'
         ]);
         $this->assertEquals('teste2', User::first()->name);
         $this->assertEquals('teste2@teste2.com', User::first()->email);
     }
     /** @test */
    public function a_user_can_be_deleted()
    {
        $this->post('/create', $this->data());
        $this->assertCount(1, User::all());
        $user = User::first();
        $response = $this->delete('user/'.$user->id);
        $this->assertCount(0, User::all());
        $response->assertRedirect('/');
    }

    private function data()
    {
        return [
            'name' => 'teste',
            'email' => 'teste@teste.com',
            'password' => '123456'
        ];
    }
}
