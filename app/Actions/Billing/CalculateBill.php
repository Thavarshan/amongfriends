<?php

namespace App\Actions\Billing;

use App\Models\Bill;
use App\Models\Charge;
use App\Models\Person;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Emberfuse\Scorch\Support\Traits\Fillable;

class CalculateBill
{
    use Fillable;

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
                $charge = $this->createCharge($bill, $charge);

                $this->calculateCharges($charge);

                collect($charge->friends)->each(function ($person) use ($charge) {
                    $hasFriend = false;

                    if (is_array($person)) {
                        $person = $person[0];

                        $hasFriend = true;
                    }

                    $person = Person::firstOrCreate(['name' => $person]);

                    $charge->wasPaidBy($person)
                        ? $this->registerPayment($person, $charge)
                        : $this->registerDebt($person, $charge, $hasFriend);

                    $person->createSpending([
                        'amount' => (int) $this->amountPerPerson,
                        'charge_id' => $charge->id,
                    ]);

                    $charge->savePerson($person);
                });
            });

            return $bill;
        });
    }

    /**
     * Create a new charge.
     *
     * @param \App\Models\Bill $bill
     * @param array            $details
     *
     * @return \App\Models\Charge
     */
    protected function createCharge(Bill $bill, array $details): Charge
    {
        return Charge::create(array_merge(
            $this->filterFillable($details, Charge::class),
            ['bill_id' => $bill->id]
        ));
    }

    /**
     * Register a new payment for the given person.
     *
     * @param \App\Models\Person $person
     * @param \App\Models\Charge $charge
     *
     * @return void
     */
    protected function registerPayment(Person $person, Charge $charge): void
    {
        $person->createPayment([
            'amount' => (int) $charge->amount,
            'charge_id' => $charge->id,
        ]);
    }

    /**
     * Register a new payment for the given person.
     *
     * @param \App\Models\Person $person
     * @param \App\Models\Charge $charge
     *
     * @return void
     */
    protected function registerDebt(Person $person, Charge $charge, bool $hasFriends = false): void
    {
        $person->createDebt([
            'amount' => $hasFriends
                ? (int) $this->amountForFrinds
                : (int) $this->amountPerPerson,
            'charge_id' => $charge->id,
            'owed_to' => $charge->paid_by,
        ]);
    }

    /**
     * Calculate billing charges.
     *
     * @param \App\Models\Charge $charge
     *
     * @return void
     */
    protected function calculateCharges(Charge $charge): void
    {
        // Example Total: 200 with 3 friends and 2 friends of friend
        // ['Kasun', 'Liam', ['Tanu', 'Ken', 'Moe']]
        $splitsTo = count(Arr::flatten($charge->friends)); // 5
        $this->amountPerPerson = $charge->amount / $splitsTo; // 40
        $friendsOfFriend = 1; // default amount

        foreach ($charge->friends as $friend) {
            if (is_array($friend)) {
                $friendsOfFriend = count($friend); // 3
            }
        }

        // 120 = 40 * 3
        $this->amountForFrinds = $this->amountPerPerson * $friendsOfFriend;
    }
}
