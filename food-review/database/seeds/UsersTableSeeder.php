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
            'address' => "Thanh Hóa",
            'city_id' => 11,
            'role_id' => 2,
            'district_id' => 148,
        ]);
    }
}
