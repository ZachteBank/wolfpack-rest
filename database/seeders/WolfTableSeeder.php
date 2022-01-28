<?php

namespace Database\Seeders;

use App\Models\Pack;
use App\Models\Wolf;
use Exception;
use Faker\Factory;
use Illuminate\Database\Seeder;

class WolfTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     * @throws Exception if the appropriate source of randomness isnt found. I dont think it will throw any time soon...
     */
    public function run()
    {
        $faker = Factory::create();

        Pack::factory(10)->create()->each(function (Pack $pack) {

            Wolf::factory(random_int(3, 8))->create(["pack_id" => $pack->id]);
        });
    }
}
