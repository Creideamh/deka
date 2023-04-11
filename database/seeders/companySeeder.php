<?php

namespace Database\Seeders;

use App\Models\company;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class companySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = faker::create();

        for ($i = 1; $i < 4; $i++) {
            $company = new company();
            $company->company_name = $faker->company();
            $company->company_logo = $faker->imageUrl($width = 640, $height = 480);
            $company->company_address = $faker->address();
            $company->email = $faker->companyEmail();
            $company->telephone = $faker->phoneNumberWithExtension();
            $company->save();
        }
    }
}
