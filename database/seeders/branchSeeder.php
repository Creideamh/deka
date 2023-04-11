<?php

namespace Database\Seeders;

use App\Models\branch;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class branchSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = faker::create();

        for ($i = 0; $i < 20; $i++) {
            $branch = new branch();
            $branch->branch_name = $faker->word(5);
            $branch->branch_code = $faker->randomNumber(4, true);
            $branch->company()->id;
        }
    }
}
