<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(1000)->create();


        $this->call([
            BusinessSeeder::class,
            PaymentLinkSeeder::class,
            SaleSeeder::class,
        ]);

        $user = User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => bcrypt('password'),
        ]);
        $business = \App\Models\Business::factory()->create([
            'name' => 'Test Business',
            'currency' => 'EUR',
        ]);
        $business->users()->attach($user->id, ['role' => 'admin']);
        $paymentLink = \App\Models\PaymentLink::factory()->create([
            'business_id' => $business->id,
            'user_id' => $user->id,
            'title' => 'Test Landlord Reference Letter',
            'amount' => 50,
            'description' => 'This is a test landlord reference letter.',
            'currency' => 'EUR',
        ]);
        \App\Models\Sale::factory(10000)->create([
            'business_id' => $business->id,
            'payment_link_id' => $paymentLink->id,
        ]);
    }
}
