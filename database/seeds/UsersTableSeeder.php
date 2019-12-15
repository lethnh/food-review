<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

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
            'password' => bcrypt('123456'),
            'address' => "Thanh Hóa",
            'status' => 1,
            'city_id' => 11,
            'role_id' => 1,
            'district_id' => 148,
        ]);

        DB::table('users')->insert([
            'name' => Str::random(10),
            'email' => 'user@gmail.com',
            'password' => bcrypt('123456'),
            'address' => "Thanh Hóa",
            'status' => 1,
            'city_id' => 11,
            'role_id' => 2,
            'district_id' => 148,
        ]);
    }
}
