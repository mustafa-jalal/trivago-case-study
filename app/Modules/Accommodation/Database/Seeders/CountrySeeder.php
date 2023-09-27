<?php

namespace App\Modules\Accommodation\Database\Seeders;

use App\Modules\Accommodation\Models\Country;
use Illuminate\Database\Seeder;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    final public function run(): void
    {
        $countries = json_decode(file_get_contents(__DIR__.'/Data/Countries.json'), true);

        foreach ($countries as $country) {
            Country::updateOrCreate(['code' => $country['code']], $country);
        }
    }
}
