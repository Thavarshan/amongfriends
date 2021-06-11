<?php

namespace App\Models;

use App\Models\Traits\Chargeable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Debt extends Model
{
    use HasFactory;
    use Chargeable;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var string[]|bool
     */
    protected $guarded = [];

    public function owedTo(): BelongsTo
    {
        return $this->belongsTo(Person::class, 'owedto_id');
    }
}