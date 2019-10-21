<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => Str::random(10),
            'email' => 'admin@gmail.com',
            'avatar' => 'admin@gmail.com',
            'password' => bcrypt('123456'),
            'address' => Str::random(10),
            'city_id' => Str::random(10),
            'district_id' => Str::random(10),
        ]);
    }
}
