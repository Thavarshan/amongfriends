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

    /**
     * Get all charges the person is a part of.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function charges(): BelongsToMany
    {
        return $this->belongsToMany(Charge::class);
    }

    /**
     * Get all payments made by the person.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class);
    }

    /**
     * Get all spendings of the person.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function spendings(): HasMany
    {
        return $this->hasMany(Spending::class);
    }

    /**
     * Get all debts the person has.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function debts(): HasMany
    {
        return $this->hasMany(Debt::class);
    }

    /**
     * Create a new payment for this person.
     *
     * @param array $details
     *
     * @return void
     */
    public function createPayment(array $details): void
    {
        $this->payments()->create($details);
    }

    /**
     * Create a new spending for this person.
     *
     * @param array $details
     *
     * @return void
     */
    public function createSpending(array $details): void
    {
        $this->spendings()->create($details);
    }

    /**
     * Create a new debt for this person.
     *
     * @param array $details
     *
     * @return void
     */
    public function createDebt(array $details): void
    {
        $this->debts()->create($details);
    }
}
