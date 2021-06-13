<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Debt;
use App\Models\Charge;
use App\Models\Person;
use App\Models\Payment;
use App\Models\Spending;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PersonTest extends TestCase
{
    use RefreshDatabase;

    public function testBelongsToCharge()
    {
        $charge = create(Charge::class);
        $person = create(Person::class);
        $charge->savePerson($person);

        $this->assertInstanceOf(Charge::class, $person->charges->first());
    }

    public function testCreatePayment()
    {
        $charge = create(Charge::class);
        $person = create(Person::class);
        $charge->savePerson($person);

        $payment = $person->createPayment([
            'amount' => 100,
            'charge_id' => $charge->id,
        ]);

        $this->assertInstanceOf(Payment::class, $payment);
        $this->assertTrue($person->payments->first()->is($payment));
    }

    public function testCreateSpending()
    {
        $charge = create(Charge::class);
        $person = create(Person::class);
        $charge->savePerson($person);

        $spending = $person->createSpending([
            'amount' => 100,
            'charge_id' => $charge->id,
        ]);

        $this->assertInstanceOf(Spending::class, $spending);
        $this->assertTrue($person->spendings->first()->is($spending));
    }

    public function testCreateDebt()
    {
        $charge = create(Charge::class);
        $person = create(Person::class);
        $charge->savePerson($person);

        $debt = $person->createDebt([
            'amount' => 100,
            'charge_id' => $charge->id,
            'owed_to' => $charge->paid_by,
        ]);

        $this->assertInstanceOf(Debt::class, $debt);
        $this->assertTrue($person->debts->first()->is($debt));
    }
}
