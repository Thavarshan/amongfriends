<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Bill;
use App\Models\Charge;
use App\Models\Person;
use App\Actions\Billing\CalculateBill;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CalculateBillTest extends TestCase
{
    use RefreshDatabase;

    public function testCalculateChargeAmounts()
    {
        $calculator = new CalculateBill();

        $file = $this->app->resourcePath('data/sample.txt');

        $contents = json_decode(file_get_contents($file), true);

        $this->assertInstanceOf(Bill::class, $calculator->calculate($contents));
    }

    public function testCalculateChargeAmountsForFriendsOfFriend()
    {
        $calculator = new CalculateBill();

        $file = $this->app->resourcePath('data/sample-nested.json');

        $contents = json_decode(file_get_contents($file), true);

        $this->assertInstanceOf(Bill::class, $calculator->calculate($contents));
    }

    public function testBillTotal()
    {
        $calculator = new CalculateBill();

        $file = $this->app->resourcePath('data/sample.json');

        $contents = json_decode(file_get_contents($file), true);

        $bill = $calculator->calculate($contents);

        $this->assertEquals(3, $bill->days);
        $this->assertEquals(250, $bill->total);
    }

    public function testPersonPaymentSpendingAndDebt()
    {
        $calculator = new CalculateBill();

        $file = $this->app->resourcePath('data/sample-nested.json');

        $contents = json_decode(file_get_contents($file), true);

        $bill = $calculator->calculate($contents);

        $kasun = Person::whereName('Kasun')->first();
        $tanu = Person::whereName('Tanu')->first();
        $liam = Person::whereName('Liam')->first();

        $this->assertEquals(50, $kasun->spent);
        $this->assertEquals(25, $kasun->in_debt);

        $this->assertEquals(83, $tanu->spent);
        $this->assertEquals(83, $tanu->in_debt);

        $this->assertEquals(91, $liam->spent);
        $this->assertEquals(25, $liam->in_debt);
    }

    public function testCalculateCharges()
    {
        // Charge has a total of 200.
        // There are 5 people here but 1 has brought his own friends.
        // So, 2 people and 3 friends of friend.
        // The 2 people without friends will have to pay 50 each.
        // The person who brought the friends will have to pay for them all
        // which means he pays 200 - (50 + 50) = 100.

        $calculator = new CalculateBill();
        $charge = create(Charge::class, [
            'amount' => 200,
            'paid_by' => 'Kasun',
            'friends' => ['Kasun', ['Tanu', 'Ken'], 'Liam'],
        ]);

        $calculator->calculateCharges($charge);

        $this->assertEquals(50, $calculator->amountPerPerson());
        $this->assertEquals(100, $calculator->amountForFrinds());
    }
}
