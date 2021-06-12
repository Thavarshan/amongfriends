<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Bill extends Model
{
    use HasFactory;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var string[]|bool
     */
    protected $guarded = [];

    public function charges(): HasMany
    {
        return $this->hasMany(Charge::class);
    }

    public function clear(): void
    {
        $this->charges->each(fn ($charge) => $charge->clear());

        $this->delete();
    }
}
