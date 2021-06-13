<?php

namespace App\Jobs;

use Throwable;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Contracts\Actions\ClearsBillInformation;

class ClearBills implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    /**
     * Execute the job.
     *
     * @param \App\Contracts\Actions\ClearsBillInformation
     *
     * @return void
     */
    public function handle(ClearsBillInformation $clearer): void
    {
        try {
            $clearer->clear();
        } catch (Throwable $e) {
            $this->fail($e);
        }
    }
}
