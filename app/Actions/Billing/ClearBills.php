<?php

namespace App\Actions\Billing;

use App\Models\Bill;
use App\Models\Charge;
use App\Models\Person;

class ClearBills
{
    /**
     * Clear all existing bills.
     *
     * @return void
     */
    public function clear(): void
    {
        Person::all()->each(fn ($bill) => $bill->delete());
        Charge::all()->each(fn ($bill) => $bill->delete());
        Bill::all()->each(fn ($bill) => $bill->delete());
    }
}
