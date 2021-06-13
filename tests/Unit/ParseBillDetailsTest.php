<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Actions\Billing\ParseBill;
use App\Actions\Billing\CalculateBill;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ParseBillDetailsTest extends TestCase
{
    use RefreshDatabase;

    /**
     * The bill instance.
     *
     * @var \App\Models\Bill
     */
    protected $bill;

    protected function setUp(): void
    {
        parent::setUp();

        $contents = json_decode(file_get_contents(
            $this->app->resourcePath('data/sample.txt')
        ), true);

        $this->bill = (new CalculateBill())->calculate($contents);
    }

    public function testParseBillDetails()
    {
        $parser = new ParseBill();
        $details = $parser->parse($this->bill);

        $this->assertEquals(250, $details['total']);
        $this->assertEquals(3, $details['days']);
        $this->assertCount(3, $details['people']);
    }
}
