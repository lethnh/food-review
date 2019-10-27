<?php

use App\Models\City;
use App\Models\District;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CitiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('cities')->delete();
        $cities = config('cities');
        foreach ($cities as $city) {
            $data = City::create(array(
                'name' => $city["state_name"],
                'priority' => $city["priority"],
            ));
            foreach ($city['districts'] as $key => $value) {
                District::create(array(
                    'name' => $value,
                    'city_id' => $data->id,
                ));
            }
        }
    }
}
