<?php

namespace App\Jobs;

use App\Events\ProductUpdated;
use App\Services\Interfaces\ProductServiceInterface;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ProcessProductUpdate implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(
        private array $updateData,
        private readonly ProductServiceInterface $productService,
    ) {
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        if(empty($this->updateData)) return;

        $this->productService->update($this->updateData);

        event(new ProductUpdated($this->updateData));
    }
}
