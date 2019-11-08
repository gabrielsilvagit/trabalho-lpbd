<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LoginTest extends TestCase
{
    use RefreshDatabase;
    /** @test */
    public function a_user_can_be_log_in_with_correct_credential()
    {
        $user = factory(User::class)->create([
            'password'=> bcrypt('password'),
        ]);
        $userData = $this->fillUserForm($user);
        $userData["password"] = 'password' ;
        $response = $this->post(route('login.post'), $userData);
        $response->assertRedirect('/');
    }
    /** @test */
    public function a_user_cant_be_log_in_with_incorrect_email()
    {
        $user = factory(User::class)->create();
        $userData = $this->fillUserForm($user);
        $userData["email"] = 'wrong@email.com';
        $response = $this->post(route('login.post'), $userData);
        $response->assertRedirect('/login');
    }
    /** @test */
    public function a_user_cant_be_log_in_with_incorrect_password()
    {
        $user = factory(User::class)->create();
        $userData = $this->fillUserForm($user);
        $userData["password"] = 'wrong_password';
        $response = $this->post(route('login.post'), $userData);
        $response->assertRedirect('/login');
    }

    /** @test */
    public function a_user_can_be_logout()
    {
        $user = factory(User::class)->create();
        Auth::login($user);
        $this->assertAuthenticatedAs($user);
        $response = $this->post(route('user.logout'));
        $this->assertGuest();
    }

    private function fillUserForm($user)
    {
        $form = [];
		$form["email"] = $user->email;
        $form["password"] = $user->password;
        return $form;
    }
}
