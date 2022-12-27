<?php

namespace Modules\Rent\Database\Seeders;

use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Rent\Entities\Rent;
use Modules\Rent\Entities\Room;

class FakeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $this->seedRent();
        $this->seedRooms(10, 5);
    }
    /**
     * Seed Rents
     * @param int $limit
     * @param int $repeat
     */
    private function seedRent(int $limit = 10, int $repeat = 1)
    {
        $faker = Factory::create();
        for ($r = 1; $r <= $repeat; $r++) {
            $data = [];
            for ($l = 1; $l <= $limit; $l++) {
                array_push($data, [
                    'title' => $faker->words(3, true),
                    'small_description' => $faker->words(10, true),
                    'description' => $faker->text,
                    'image' => '/',
                    'address' => '/',
                    'open' => $faker->boolean(80),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
            Rent::query()->insert($data);
        }
    }


    /**
     * Seed Rooms
     * @param int $limit
     * @param int $repeat
     */
    private function seedRooms(int $limit = 10, int $repeat = 1)
    {
        $faker = Factory::create();
        for ($r = 1; $r <= $repeat; $r++) {
            $data = [];
            for ($l = 1; $l <= $limit; $l++) {
                array_push($data, [
                    'title' => $faker->words(3, true),
                    'description' => $faker->text,
                    'image' => '/',
                    'capacity' => $faker->numberBetween(1, 10),
                    'open' => $faker->boolean(80),
                    'rent_id' => $faker->numberBetween(1, Rent::count()),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
            Room::query()->insert($data);
        }
    }
}
