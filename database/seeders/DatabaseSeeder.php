<?php

namespace Database\Seeders;

use App\Modules\Accommodation\Database\Seeders\CountrySeeder;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    final public function run(): void
    {
        $this->call([
            CountrySeeder::class
        ]);
    }
}
