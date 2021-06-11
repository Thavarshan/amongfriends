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

    public function bill(): BelongsTo
    {
        return $this->belongsTo(Bill::class);
    }

    public function people(): BelongsToMany
    {
        return $this->belongsToMany(Person::class);
    }

    public function payment(): HasOne
    {
        return $this->hasOne(Payment::class);
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
