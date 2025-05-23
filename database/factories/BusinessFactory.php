<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Business>
 */
class BusinessFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->company,
            'email' => $this->faker->unique()->safeEmail,
            'phone' => $this->faker->phoneNumber,
            'address_line1' => $this->faker->streetAddress,
            'address_line2' => $this->faker->secondaryAddress,
            'address_line3' => $this->faker->city,
            'address_line4' => $this->faker->state,
            'postal_code' => $this->faker->postcode,
            'city' => $this->faker->city,
            'country' => $this->faker->country,
            'website' => $this->faker->url,
            'logo' =>  '/icons-sample/business-' . random_int(1, 4) . '.jpg',
            'vat_number' => $this->faker->randomNumber(8),
            'tax_number' => $this->faker->randomNumber(8),
            'currency' => $this->faker->currencyCode,
        ];
    }
}
