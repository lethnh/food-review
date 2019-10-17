<?php

use Illuminate\Database\Seeder;

class ShopsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();
        foreach (range(1, 50) as $index) {
            DB::table('shops')->insert([
                'name' => Str::random(10),
                'description' => 'admin@gmail.com',
                'address' => Str::random(10),
                'city_id' => Str::random(10),
                'district_id' => Str::random(10),
                'lat' => $faker->numberBetween($min = 1000, $max = 9000),
                'lng' => $faker->numberBetween($min = 1000, $max = 9000),
                'type' => Str::random(10),
            ]);
        };
    }
}
