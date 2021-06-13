<?php

namespace App\Contracts\Support;

interface Cancellable
{
    /**
     * Cancel a course of action or a resource.
     *
     * @return void
     */
    public function cancel(): void;
}
