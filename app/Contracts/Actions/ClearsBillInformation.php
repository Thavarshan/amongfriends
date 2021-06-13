<?php

namespace App\Contracts\Actions;

interface ClearsBillInformation
{
    /**
     * Clear all existing bills.
     *
     * @return void
     */
    public function clear(): void;
}
