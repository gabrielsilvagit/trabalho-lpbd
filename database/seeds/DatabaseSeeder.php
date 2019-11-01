<?php

use App\User;
use App\Service;
use Faker\Generator as Faker;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Allan',
            'email' => 'allan@hotmail.com',
            'password' => bcrypt('123'),
        ]);
        DB::table('users')->insert([
            'name' => 'Gabriel',
            'email' => 'gabriel@hotmail.com',
            'password' => bcrypt('123'),
        ]);
        DB::table('users')->insert([
            'name' => 'Luan',
            'email' => 'luan@hotmail.com',
            'password' => bcrypt('123'),
        ]);
        factory(App\Service::class, 15)->create([
            'user_id' => 1,
        ]);
        factory(App\Service::class, 15)->create([
            'user_id' => 2,
        ]);
        factory(App\Service::class, 15)->create([
            'user_id' => 3,
        ]);
        factory(App\Service::class, 455)->create();

        $services = Service::all();
        foreach($services as $service) {
            for($i = 0; $i < 10; $i++) {
                $id = rand(1,500);
                $user = User::where('id', '=', $id)->first();
                $service->user()->attach($user);
            }
        }
    }
}
