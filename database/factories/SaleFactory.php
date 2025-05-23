<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Sale>
 */
class SaleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'created_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'business_id' => \App\Models\Business::factory(),
            'payment_link_id' => \App\Models\PaymentLink::factory(),
            'amount' => $this->faker->randomFloat(2, 1, 1000),
            'currency' => $this->faker->currencyCode,
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'phone' => $this->faker->phoneNumber,
            'reference' => $this->faker->uuid,
            'status' => $this->faker->randomElement(['completed', 'pending', 'failed']),
            'transaction_id' => $this->faker->uuid,
            'payment_method' => $this->faker->randomElement(['credit_card', 'paypal', 'bank_transfer']),
            'stripe_payment_intent_id' => $this->faker->uuid,
        ];
    }
}
