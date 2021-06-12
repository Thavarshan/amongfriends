<?php

namespace App\Models\Traits;

use App\Models\Charge;
use App\Models\Person;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait Chargeable
{
    /**
     * Get the charge this payment belongs to.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function charges(): BelongsTo
    {
        return $this->belongsTo(Charge::class);
    }

    /**
     * Get the person this payment belongs to.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function person(): BelongsTo
    {
        return $this->belongsTo(Person::class);
    }
}
