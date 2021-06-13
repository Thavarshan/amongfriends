<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Bill;
use App\Models\Charge;
use App\Models\Person;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ChargeTest extends TestCase
{
    use RefreshDatabase;

    public function testBelongsToBill()
    {
        $bill = create(Bill::class);
        $charge = create(Charge::class, ['bill_id' => $bill->id]);

        $this->assertInstanceOf(Bill::class, $charge->bill);
        $this->assertTrue($charge->bill->is($bill));
    }

    public function testHasManyToPeople()
    {
        $bill = create(Bill::class);
        $person = create(Person::class);
        $charge = create(Charge::class, ['bill_id' => $bill->id]);
        $charge->savePerson($person);

        $this->assertInstanceOf(Person::class, $charge->people->first());
        $this->assertTrue($person->is($charge->people->first()));
    }

    public function testDeterineWhoPaidCharge()
    {
        $bill = create(Bill::class);
        $personOne = create(Person::class);
        $personTwo = create(Person::class);
        $charge = create(Charge::class, [
            'bill_id' => $bill->id,
            'paid_by' => $personOne->name,
        ]);
        $charge->savePerson($personOne);
        $charge->savePerson($personTwo);

        $this->assertTrue($charge->wasPaidBy($personOne));
        $this->assertFalse($charge->wasPaidBy($personTwo));
    }

    public function testChargeCancellation()
    {
        $bill = create(Bill::class);
        $personOne = create(Person::class);
        $personTwo = create(Person::class);
        $charge = create(Charge::class, [
            'bill_id' => $bill->id,
            'paid_by' => $personOne->name,
        ]);
        $charge->savePerson($personOne);
        $charge->savePerson($personTwo);

        $charge->cancel();

        $this->assertNull($charge->fresh());
        $this->assertNull($personTwo->fresh());
        $this->assertNull($personOne->fresh());
    }
}
