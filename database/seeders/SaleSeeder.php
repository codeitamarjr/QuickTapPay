<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SaleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Sale::factory()->count(10)->create([
            'payment_link_id' => \App\Models\PaymentLink::factory()->create()->id,
        ]);
        \App\Models\Sale::factory()->count(10)->create([
            'payment_link_id' => \App\Models\PaymentLink::factory()->create()->id,
        ]);
        \App\Models\Sale::factory()->count(10)->create([
            'payment_link_id' => \App\Models\PaymentLink::factory()->create()->id,
            'status' => 'completed',
        ]);
        \App\Models\Sale::factory()->count(10)->create([
            'payment_link_id' => \App\Models\PaymentLink::factory()->create()->id,
            'status' => 'pending',
        ]);
        \App\Models\Sale::factory()->count(10)->create([
            'payment_link_id' => \App\Models\PaymentLink::factory()->create()->id,
            'status' => 'completed',
            'payment_method' => 'credit_card',
        ]);
    }
}
