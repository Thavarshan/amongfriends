<?php

namespace App\Contracts\Actions;

interface CalculatesBillInfromation
{
    /**
     * Parse the given billing data and calculate payment amounts.
     *
     * @param array $data
     *
     * @return mixed
     */
    public function calculate(array $data);
}
