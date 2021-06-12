<?php

namespace App\Actions\Billing;

use App\Models\Bill;
use App\Models\Charge;
use App\Models\Person;
use Illuminate\Support\Facades\DB;

class ClearBills
{
    /**
     * Clear all existing bills.
     *
     * @return void
     */
    public function clear(): void
    {
        DB::transaction(function (): void {
            Person::all()->each(fn (Person $person) => $person->delete());
            Charge::all()->each(fn (Charge $charge) => $charge->delete());
            Bill::all()->each(fn (Bill $bill) => $bill->delete());
        });
    }
}
