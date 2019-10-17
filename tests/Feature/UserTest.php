<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserTest extends TestCase
{
    use refreshDatabase;

    /** @test */
    public function a_user_can_be_created()
    {
        $user = factory(User::class)->make();
        $userForm = $this->fillUserForm($user);
        $response = $this->post(route('user.register.post'), $userForm);
        $user = User::all();
        $this->assertCount(1, User::all());
        $response->assertRedirect(route('login'));
    }
    /** @test */
    public function a_name_is_required()
    {
        $user = factory(User::class)->make();
        $user['name']="";
        $userForm = $this->fillUserForm($user);
        $response = $this->post(route('user.register.post'), $userForm);
        $this->assertCount(0, User::all());
    }
    /** @test */
    public function an_email_is_required()
    {
        $user = factory(User::class)->make();
        $user['email']="";
        $userForm = $this->fillUserForm($user);
        $response = $this->post(route('user.register.post'), $userForm);
        $this->assertCount(0, User::all());
    }
    /** @test */
    public function a_password_is_required()
    {
        $user = factory(User::class)->make();
        $user['password']= null;
        $userForm = $this->fillUserForm($user);
        $response = $this->post(route('user.register.post'), $userForm);
        $this->assertCount(0, User::all());
    }
     /** @test */
    public function a_user_can_be_updated()
    {
        $user = factory(User::class)->create();
        Auth::login($user);
        $user = User::first();
        $this->assertDatabaseHas('users', [
            'email' => $user->email
        ]);
        $newUserData = factory(User::class)->make();
        $userData = $this->fillUserForm($newUserData);
        $response = $this->patch(route('user.edit.post', $user->id),$userData);
        $this->assertEquals($userData['name'], User::first()->name);
        $this->assertEquals($userData['email'], User::first()->email);
    }
     /** @test */
    public function a_user_can_be_deleted()
    {
        $user = factory(User::class)->create();
        Auth::login($user);
        $user = User::first();
        $this->assertDatabaseHas('users', [
            'email' => $user->email
        ]);
        $response = $this->delete(route('user.delete', $user->id));
        $this->assertCount(0, User::all());
        $response->assertRedirect('/login');
    }

    private function fillUserForm($user)
    {
        $form = [];
		$form["name"] = $user->name;
		$form["email"] = $user->email;
        $form["password"] = $user->password;
        return $form;
    }
}
