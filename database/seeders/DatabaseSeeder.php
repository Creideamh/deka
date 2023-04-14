<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        $this->call([
            CountrySeeder::class,
            eternity_option_seeder::class,
            CompanySeed::class,
            UserSeed::class
        ]);



        // \App\Models\User::factory(20)->create();
    }
}
