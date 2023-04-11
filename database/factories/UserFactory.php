<?php

namespace Database\Factories;

use App\Models\branch;
use App\Models\company;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Faker\Factory as Faker;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
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
            'firstname' => fake()->firstName(),
            'lastname' => fake()->lastName(),
            'birthdate' => fake()->date(),
            'gender' => 'M',
            'country' => fake()->country(),
            'cellphone' => fake()->phoneNumber(),
            'jobTitle' => fake()->jobTitle(),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => '$2a$12$Yf7uffUKjsNz.zXeOklSvukYj2HULG7hKEeNiSQHQbauEwB2G372a', // P@$$w0rd
            'remember_token' => Str::random(10),
            'status' => '1',
            'userImage' => 'no_image.png',
            'branch_id' => $faker->randomDigitNotNull(),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return static
     */
    public function unverified()
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
