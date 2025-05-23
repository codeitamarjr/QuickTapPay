<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PaymentLink>
 */
class PaymentLinkFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'business_id' => \App\Models\Business::factory(),
            'user_id' => \App\Models\User::factory(),
            'title' => $this->faker->sentence,
            'amount' => $this->faker->randomFloat(2, 1, 1000),
            'slug' => $this->faker->slug,
            'description' => $this->faker->paragraph,
            'status' => $this->faker->randomElement(['active', 'inactive']),
            'payment_method' => $this->faker->randomElement(['credit_card', 'paypal', 'bank_transfer']),
            'currency' => $this->faker->currencyCode,
        ];
    }
}
