<?php

namespace App\Models\Traits;

use App\Support\Money;

trait Payable
{
    /**
     * Get the total amount that will be paid.
     *
     * @return string
     */
    public function amount(): string
    {
        return Money::format($this->rawAmount());
    }

    /**
     * Get the raw total amount that will be paid.
     *
     * @return int
     */
    public function rawAmount(): int
    {
        return (int) $this->amount;
    }
}
