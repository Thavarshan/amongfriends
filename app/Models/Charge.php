<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Charge extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'bill_id',
        'amount',
        'paid_by',
        'friends',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'friends' => 'array',
    ];

    /**
     * The relations to eager load on every query.
     *
     * @var array
     */
    protected $with = ['people'];

    /**
     * Get the bill the charge belogs to.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function bill(): BelongsTo
    {
        return $this->belongsTo(Bill::class);
    }

    /**
     * Get all the people that belong to this charge.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function people(): BelongsToMany
    {
        return $this->belongsToMany(Person::class);
    }

    /**
     * Get the payment that belong to this charge.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function payment(): HasOne
    {
        return $this->hasOne(Payment::class);
    }

    /**
     * Get all spendings that belong to this charge.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function spendings(): HasMany
    {
        return $this->hasMany(Spending::class);
    }

    /**
     * Get all debts that belong to this charge.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function debts(): HasMany
    {
        return $this->hasMany(Debt::class);
    }

    /**
     * Determine if the charge was paid by the given person.
     *
     * @param mixed $person
     *
     * @return bool
     */
    public function wasPaidBy($person): bool
    {
        if (! is_string($person)) {
            $person = $person->name;
        }

        return $this->paid_by === $person;
    }

    /**
     * Save the given person to this charge.
     *
     * @param \App\Models\Person $person
     *
     * @return void
     */
    public function savePerson(Person $person): void
    {
        $this->people()->save($person);
    }
}
