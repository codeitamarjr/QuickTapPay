<?php

namespace Tests;

use App\Models\Business;
use App\Models\PaymentLink;
use App\Models\User;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Support\Str;

abstract class TestCase extends BaseTestCase
{
    protected function completeOnboarding(User $user): void
    {
        $business = Business::factory()->create();
        $business->users()->attach($user, ['role' => 'admin']);

        if (empty($user->stripe_account_id)) {
            $user->forceFill(['stripe_account_id' => 'acct_' . Str::random(8)])->save();
        }

        PaymentLink::factory()
            ->for($business)
            ->for($user)
            ->create();

        $user->refresh();
    }
}
