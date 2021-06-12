<?php

namespace App\Actions\Billing;

use App\Models\Bill;

class ParseBillDetails
{
    public function parse(Bill $bill): array
    {
        // Total amount
        $total = $bill->charges->pluck('amount')->sum();

        // Total days
        $days = $bill->charges->count();

        // Friends
        $people = [];

        foreach ($bill->charges as $charge) {
            foreach ($charge->people as $person) {
                if (array_key_exists($person->name, $people)) {
                    continue;
                }

                $people[$person->name] = $person;
            }
        }

        return compact('total', 'days', 'people');
    }
}
