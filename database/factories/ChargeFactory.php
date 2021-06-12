<?php

namespace Database\Factories;

use App\Models\Bill;
use App\Models\Charge;
use Illuminate\Database\Eloquent\Factories\Factory;

class ChargeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Charge::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'amount' => 100,
            'paid_by' => 'Kasun',
            'friends' => ['Kasun', ['Tanu', 'Ken'], 'Liam'],
            'bill_id' => Bill::create(['code' => uniqid()])->id,
        ];
    }
}
