<?php

namespace App\Actions\Billing;

use App\Models\Bill;

class ParseBillDetails
{
    /**
     * Parse the given bill details to a presentable format.
     *
     * @param \App\Models\Bill $bill
     *
     * @return array
     */
    public function parse(Bill $bill): array
    {
        $people = [];

        foreach ($bill->charges as $charge) {
            foreach ($charge->people as $person) {
                if (array_key_exists($person->name, $people)) {
                    continue;
                }

                $people[$person->name] = $person;
            }
        }

        return array_merge([
            'total' => $bill->total,
            'days' => $bill->days,
        ], compact('people'));
    }
}
