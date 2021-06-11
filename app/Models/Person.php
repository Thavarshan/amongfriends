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
