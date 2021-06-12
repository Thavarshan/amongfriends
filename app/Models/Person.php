<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Person extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name'];

    /**
     * The relations to eager load on every query.
     *
     * @var array
     */
    protected $with = ['payments', 'spendings', 'debts'];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'spent',
        'in_debt',
    ];

    /**
     * Get the total amount spent.
     *
     * @return int
     */
    public function getSpentAttribute(): int
    {
        return $this->spendings->pluck('amount')->sum();
    }

    /**
     * Get the total amount spent.
     *
     * @return int
     */
    public function getInDebtAttribute(): int
    {
        return $this->debts->pluck('amount')->sum();
    }

    public function charges(): BelongsToMany
    {
        return $this->belongsToMany(Charge::class);
    }

    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class);
    }

    public function spendings(): HasMany
    {
        return $this->hasMany(Spending::class);
    }

    public function debts(): HasMany
    {
        return $this->hasMany(Debt::class);
    }
}
