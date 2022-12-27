<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Application;
use App\Models\User;
use App\Models\UserProfile;
use Faker\Factory;
use Illuminate\Database\Seeder;
use TCG\Voyager\Models\Role;

class FakeSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([DatabaseSeeder::class]);

        $user = User::query()->insert([
            'name' => 'Admin-Test',
            'email' => 'admin@admin.com',
            'password' => bcrypt('admin'),
            'role_id' => Role::query()->where('name', 'admin')->first()->id
        ]);

        Application::query()->insert([
            'title' => 'Application Test',
            'description' => 'Application Test',
            'version_name' => '0.0.1',
            'version_code' => 1,
            'contact' => 'admin@admin.com',
            'active' => true
        ]);

        $this->seedUsers();
    }
    /**
     * seedUsers
     */
    private function seedUsers(int $limit = 10, int $repeat = 1)
    {
        $faker = Factory::create();
        $role_id = Role::query()->where('name', 'user')->first()->id;
        for ($r = 1; $r <= $repeat; $r++) {
            $users = [];
            $profiles = [];
            for ($l = 1; $l <= $limit; $l++) {
                $email = $faker->email();
                array_push($users, [
                    'name' => $faker->name,
                    'email' => $email,
                    'password' => bcrypt('admin'),
                    'role_id' => $role_id,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
                array_push($profiles, [
                    'user_id' => ($l * $r) + 1,
                    'first_name' => $faker->firstName(),
                    'last_name' => $faker->lastName(),
                    'tel' => $faker->phoneNumber(),
                    'address' => json_encode([
                        'country' => $faker->country(),
                        'state' => $faker->word(),
                        'city' => $faker->city(),
                        'address' => $faker->address(),
                        'postal_code' => $faker->postcode(),
                    ])
                ]);
            }
            User::query()->insert($users);
            UserProfile::query()->insert($profiles);
        }
    }
}
