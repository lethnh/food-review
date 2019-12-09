<?php

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            'name' => 'admin',
            'description' => 'admin@gmail.com',
        ]);
        DB::table('roles')->insert([
            'name' => 'user',
            'description' => 'admin@gmail.com',
        ]);
    }
}
