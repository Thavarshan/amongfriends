<?php

namespace App\Providers;

use App\Actions\Billing\ClearBill;
use App\Actions\Billing\ParseBill;
use App\Actions\Billing\CalculateBill;
use Illuminate\Support\ServiceProvider;
use App\Contracts\Actions\ClearsBillInformation;
use App\Contracts\Actions\ParsesBillInformation;
use Emberfuse\Scorch\Providers\Traits\HasActions;
use App\Contracts\Actions\CalculatesBillInfromation;

class AppServiceProvider extends ServiceProvider
{
    use HasActions;

    /**
     * The scorch action classes.
     *
     * @var array
     */
    protected $actions = [
        CalculatesBillInfromation::class => CalculateBill::class,
        ParsesBillInformation::class => ParseBill::class,
        ClearsBillInformation::class => ClearBill::class,
    ];

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerActions();
    }
}
