<?php

namespace App\Models;

use App\Models\Traits\Payable;
use App\Models\Traits\Chargeable;
use Illuminate\Database\Eloquent\Model;
use App\Contracts\Billing\Payment as PaymentContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Payment extends Model implements PaymentContract
{
    use HasFactory;
    use Chargeable;
    use Payable;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var string[]|bool
     */
    protected $guarded = [];

    /**
     * Cancel a course of action or a resource.
     *
     * @return void
     */
    public function cancel(): void
    {
        $this->delete();
    }
}
