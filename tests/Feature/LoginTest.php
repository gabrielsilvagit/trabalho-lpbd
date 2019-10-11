<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LoginTest extends TestCase
{
    /** @test */
    public function a_user_can_be_log_in_with_correct_credential()
    {
        $user = factory(User::class)->create();
        $userData = $this->fillUserForm($user);
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
        $response->assertRedirect('/');
    }
    /** @test */
    public function a_user_cant_be_log_in_with_incorrect_password()
    {
        $user = factory(User::class)->create();
        $userData = $this->fillUserForm($user);
        $userData["password"] = 'wrong_password';
        $response = $this->post(route('login.post'), $userData);
        $response->assertRedirect('/');
    }

    private function fillUserForm($user)
    {
        $form = [];
		$form["email"] = $user->email;
        $form["password"] = $user->password;
        return $form;
    }
}
