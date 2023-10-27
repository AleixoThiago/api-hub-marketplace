<?php

namespace App\Jobs;

use App\Services\Interfaces\OfferServiceInterface;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ProcessOfferUpdate implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(
        private readonly array $updateData,
        private readonly OfferServiceInterface $offerService,
    ) {
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        if(empty($this->updateData)) return;

        $this->offerService->update($this->updateData);
    }
}
