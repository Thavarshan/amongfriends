<?php

namespace Tests\Feature\Billing;

use Tests\TestCase;
use Tests\Concerns\BillDataProvider;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SplitBillTest extends TestCase
{
    use RefreshDatabase;
    use BillDataProvider;

    public function testBillSplitterViewIsRendered()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function testBillSplittingWithNormalData()
    {
        $response = $this->from('/')
            ->post('/bills', [
                'bill' => $this->sampleData(true),
            ]);

        $response->assertStatus(303);
        $response->assertRedirect('/bills/1');
        $response->assertSessionHasNoErrors();
    }

    public function testBillSplittingWithNestedData()
    {
        $response = $this->from('/')
            ->post('/bills', [
                'bill' => $this->sampleNestedData(true),
            ]);

        $response->assertStatus(303);
        $response->assertRedirect('/bills/1');
        $response->assertSessionHasNoErrors();
    }

    public function testBillSplittingWithNormalDataThroughJsonRequest()
    {
        $response = $this->from('/')
            ->postJson('/bills', [
                'bill' => $this->sampleData(true),
            ]);

        $response->assertStatus(201);
    }

    public function testBillSplittingWithNestedDataThroughJsonRequest()
    {
        $response = $this->from('/')
            ->postJson('/bills', [
                'bill' => $this->sampleNestedData(true),
            ]);

        $response->assertStatus(201);
    }

    public function testValidDataRequired()
    {
        $response = $this->from('/')->post('/bills', []);

        $response->assertStatus(403);
    }
}
