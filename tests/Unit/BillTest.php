<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Bill;
use App\Models\Charge;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BillTest extends TestCase
{
    use RefreshDatabase;

    public function testHasCharge()
    {
        $bill = create(Bill::class);
        $charge = create(Charge::class, ['bill_id' => $bill->id]);

        $this->assertInstanceOf(Charge::class, $bill->charges->first());
        $this->assertTrue($charge->is($bill->charges->first()));
    }

    public function testGetToalAndNumberOfDays()
    {
        $bill = create(Bill::class);
        create(Charge::class, ['bill_id' => $bill->id, 'amount' => 250]);

        $this->assertEquals(250, $bill->total);
        $this->assertEquals(1, $bill->days);
    }

    public function testBillCancellation()
    {
        $bill = create(Bill::class);
        $charge = create(Charge::class, ['bill_id' => $bill->id]);

        $this->assertTrue($charge->is($bill->charges->first()));

        $bill->cancel();

        $this->assertNull($bill->fresh());
        $this->assertNull($charge->fresh());
    }
}
