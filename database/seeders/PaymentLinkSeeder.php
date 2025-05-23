<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PaymentLinkSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\PaymentLink::factory()->count(10)->create([
            'business_id' => \App\Models\Business::factory()->create()->id,
        ]);
        \App\Models\PaymentLink::factory()->count(10)->create([
            'business_id' => \App\Models\Business::factory()->create()->id,
            'user_id' => \App\Models\User::factory()->create()->id,
        ]);
        \App\Models\PaymentLink::factory()->count(10)->create([
            'business_id' => \App\Models\Business::factory()->create()->id,
            'user_id' => \App\Models\User::factory()->create()->id,
            'status' => 'active',
        ]);
        \App\Models\PaymentLink::factory()->count(10)->create([
            'business_id' => \App\Models\Business::factory()->create()->id,
            'user_id' => \App\Models\User::factory()->create()->id,
            'status' => 'inactive',
        ]);
        \App\Models\PaymentLink::factory()->count(10)->create([
            'business_id' => \App\Models\Business::factory()->create()->id,
            'user_id' => \App\Models\User::factory()->create()->id,
            'status' => 'active',
            'payment_method' => 'credit_card',
        ]);
    }
}
