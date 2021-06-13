<?php

namespace Tests\Feature\Billing;

use Tests\TestCase;
use App\Models\Bill;
use App\Jobs\ClearBills;
use Illuminate\Support\Facades\Queue;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ClearsBillsTest extends TestCase
{
    use RefreshDatabase;

    public function testClearsAllBills()
    {
        create(Bill::class, [], null, 20);

        $this->assertCount(20, Bill::all());

        $response = $this->get('/');

        $response->assertStatus(200);

        $this->assertCount(0, Bill::all());
    }

    public function testJobClearsAllBills()
    {
        Queue::fake();

        $response = $this->get('/');

        Queue::assertPushed(ClearBills::class);

        $response->assertStatus(200);
    }
}
