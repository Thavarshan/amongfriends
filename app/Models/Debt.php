<?php

namespace App\Models;

use App\Models\Traits\Chargeable;
use App\Contracts\Billing\Payable;
use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\Payable as PayableTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Debt extends Model implements Payable
{
    use HasFactory;
    use Chargeable;
    use PayableTrait;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var string[]|bool
     */
    protected $guarded = [];
}
