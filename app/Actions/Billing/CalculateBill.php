<?php

namespace App\Actions\Billing;

use App\Models\Bill;
use App\Models\Charge;
use App\Models\Person;
use Illuminate\Support\Facades\DB;

class CalculateBill
{
    /**
     * Parse the given billing data and calculate payment amounts.
     *
     * @param array $data
     *
     * @return mixed
     */
    public function calculate(array $data)
    {
        return DB::transaction(function () use ($data) {
            $bill = Bill::create(['code' => uniqid()]);

            collect($data)->each(function ($charge) use ($bill) {
                $charge = Charge::create([
                    'bill_id' => $bill->id,
                    'amount' => $charge['amount'],
                    'paid_by' => $charge['paid_by'],
                    'friends' => $charge['friends'],
                ]);

                collect($charge['friends'])->each(function ($person) use ($charge) {
                    $person = Person::firstOrCreate(['name' => $person]);

                    if ($charge->paid_by === $person->name) {
                        $person->payments()->create([
                            'amount' => $charge->amount,
                            'charge_id' => $charge->id,
                        ]);
                    } else {
                        $person->debts()->create([
                            'amount' => $charge->amount / count($charge->friends),
                            'charge_id' => $charge->id,
                            'owed_to' => $charge->paid_by,
                        ]);
                    }

                    $person->spendings()->create([
                        'amount' => $charge->amount / count($charge->friends),
                        'charge_id' => $charge->id,
                    ]);

                    $charge->people()->save($person);
                });
            });

            return $bill;
        });
    }
}
