<?php

namespace App\Actions\Billing;

use App\Models\Bill;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Collection;
use App\Contracts\Actions\ClearsBillInformation;

class ClearBill implements ClearsBillInformation
{
    /**
     * Clear all existing bills.
     *
     * @return void
     */
    public function clear(): void
    {
        DB::transaction(function (): void {
            tap(Bill::all(), function (Collection $bills): void {
                $bills->each(fn (Bill $bill) => $bill->cancel());
            });
        });
    }
}
