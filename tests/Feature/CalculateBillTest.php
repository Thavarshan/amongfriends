<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Bill;
use App\Actions\Billing\CalculateBill;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CalculateBillTest extends TestCase
{
    use RefreshDatabase;

    public function testCalculateChargeAmounts()
    {
        $this->withoutExceptionHandling();

        $calculator = new CalculateBill();

        $file = $this->app->resourcePath('data/sample.txt');

        $contents = json_decode(file_get_contents($file), true);

        $this->assertInstanceOf(Bill::class, $calculator->calculate($contents));
    }
}
