<?php

namespace App\Contracts\Billing;

use App\Contracts\Support\Cancellable;
use Illuminate\Contracts\Support\Arrayable;

interface Payment extends Payable, Arrayable, Cancellable
{
}
