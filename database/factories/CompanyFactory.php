<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Factory as Faker;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Company>
 */
class CompanyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $faker = Faker::create();

        return [
            "company_name" => $faker->company(),
            "company_logo" => $faker->imageUrl($width = 640, $height = 480),
            "company_address" => $faker->address(),
            "email" => $faker->companyEmail(),
            "telephone" => $faker->phoneNumberWithExtension(),
        ];
    }
}
