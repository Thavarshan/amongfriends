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

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'total',
        'days',
    ];

    /**
     * Get all charges that belong to this bill.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function charges(): HasMany
    {
        return $this->hasMany(Charge::class);
    }

    /**
     * Get the bill total.
     *
     * @return int
     */
    public function getTotalAttribute(): int
    {
        return $this->charges->pluck('amount')->sum();
    }

    /**
     * Get the number of days this bill is calculated for.
     *
     * @return int
     */
    public function getDaysAttribute(): int
    {
        return $this->charges->count();
    }

    /**
     * Clear all details related to this bill and remove it from the database.
     *
     * @return void
     */
    public function clear(): void
    {
        $this->charges->each(fn ($charge) => $charge->clear());

        $this->delete();
    }
}
