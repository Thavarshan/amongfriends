<?php

namespace App\Contracts\Actions;

use App\Models\Bill;

interface ParsesBillInformation
{
    /**
     * Parse the given bill details to a presentable format.
     *
     * @param \App\Models\Bill $bill
     *
     * @return array
     */
    public function parse(Bill $bill): array;
}
