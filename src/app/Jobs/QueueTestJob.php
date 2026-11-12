<?php

namespace App\Jobs;

use App\Services\ComposeManager;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Cache;

class QueueTestJob implements ShouldQueue
{
    use Queueable;

    public function __construct()
    {
        $this->onQueue('docker-updates');
    }

    public function handle(ComposeManager $compose): void
    {
        $status = $compose->status();

        Cache::put('docker-manager:queue-test', [
            'status' => 'succeeded',
            'executed_at' => now()->toIso8601String(),
            'containers' => $status,
        ], now()->addMinutes(10));
    }
}
