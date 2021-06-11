<?php

namespace App\Models\Traits;

use App\Models\Charge;
use App\Models\Person;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait Chargeable
{
    public function charges(): BelongsTo
    {
        return $this->belongsTo(Charge::class);
    }

    public function person(): BelongsTo
    {
        return $this->belongsTo(Person::class);
    }
}
