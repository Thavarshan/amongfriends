<?php

namespace App\Jobs;

use Throwable;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Actions\Billing\ClearBills as ClearBillsAction;

class ClearBills implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    /**
     * Execute the job.
     *
     * @param \App\Actions\ClearBillsAction
     *
     * @return void
     */
    public function handle(ClearBillsAction $clearer): void
    {
        try {
            $clearer->clear();
        } catch (Throwable $e) {
            throw $e;
            // $this->fail($e);
        }
    }
}
