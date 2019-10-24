<?php

namespace Tests\Feature;

use App\User;
use App\Service;
use Tests\TestCase;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ServiceTest extends TestCase
{
    use	RefreshDatabase;

    protected $loggedUser;

	// public function setUp()
	// {
    //     parent::setUp();
    //     $this->loggedUser = factory(User::class)->create();
    //     Auth::login($this->loggedUser);
    // }

    /** @test */
    public function a_user_can_create_a_service()
    {
        $this->loggedUser = factory(User::class)->create();
        Auth::login($this->loggedUser);
        $service = [
            'title' => 'Pintura',
            'description' => 'Faço pinturas em geral',
            'price' => 'R$ 150,00 por dia',
        ];
        $response = $this->post(route('service.store'), $service);
        $this->assertCount(1, Service::all());
    }
    /** @test */
    public function a_user_cannot_create_a_service_without_title()
    {
        $this->loggedUser = factory(User::class)->create();
        Auth::login($this->loggedUser);
        $service = [
            'title' => null,
            'description' => 'Faço pinturas em geral',
            'price' => 'R$ 150,00 por dia',
        ];
        $response = $this->post(route('service.store'), $service);
        $this->assertCount(0, Service::all());
    }
    /** @test */
    public function a_user_cannot_create_a_service_without_description()
    {
        $this->loggedUser = factory(User::class)->create();
        Auth::login($this->loggedUser);
        $service = [
            'title' => 'Pintura',
            'description' => null,
            'price' => 'R$ 150,00 por dia',
        ];
        $response = $this->post(route('service.store'), $service);
        $this->assertCount(0, Service::all());
    }
    /** @test */
    public function a_user_cannot_create_a_service_without_price()
    {
        $this->loggedUser = factory(User::class)->create();
        Auth::login($this->loggedUser);
        $service = [
            'title' => 'Pintura',
            'description' => 'Faço pinturas em geral',
            'price' => null,
        ];
        $response = $this->post(route('service.store'), $service);
        $this->assertCount(0, Service::all());
    }

    /** @test */
    public function a_service_can_be_updated()
    {
        $this->loggedUser = factory(User::class)->create();
        Auth::login($this->loggedUser);
        $serviceData = [
            'title' => 'Pintura',
            'description' => 'Faço pinturas em geral',
            'price' => 'R$ 150,00 por dia',
        ];
        $response = $this->post(route('service.store'), $serviceData);
        $this->assertCount(1, Service::all());
        $this->assertDatabaseHas('services', [
            'title' => 'Pintura',
            'description' => 'Faço pinturas em geral',
            'price' => 'R$ 150,00 por dia',
        ]);

        $service = Service::first();
        $newServiceData = [
            'title' => 'Carreta',
            'description' => 'Faço carretas em geral',
            'price' => 'R$ 200,00 por dia',
        ];
        $response = $this->patch(route('service.update', $service), $newServiceData);
        $this->assertCount(1, Service::all());
        $this->assertDatabaseHas('services', [
            'title' => 'Carreta',
            'description' => 'Faço carretas em geral',
            'price' => 'R$ 200,00 por dia',
        ]);
    }
    /** @test */
    public function a_service_can_be_deleted()
    {
        $this->loggedUser = factory(User::class)->create();
        Auth::login($this->loggedUser);
        $serviceData = [
            'title' => 'Pintura',
            'description' => 'Faço pinturas em geral',
            'price' => 'R$ 150,00 por dia',
        ];
        $response = $this->post(route('service.store'), $serviceData);
        $this->assertCount(1, Service::all());
        $service = Service::first();
        $response = $this->delete(route('service.delete', $service));
        $this->assertCount(0, Service::all());
        $response->assertRedirect(route('show.user', $service->owner));
    }

    private function fillServiceForm($service)
    {
        $form = [];
		$form["title"] = $service->title;
		$form["description"] = $service->description;
        $form["price"] = $service->price;
        $form["user_id"] = $service->owner;
        return $form;
    }
}
