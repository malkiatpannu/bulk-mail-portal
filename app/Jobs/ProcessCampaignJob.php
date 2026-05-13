<?php

namespace App\Jobs;

use App\Models\Campaign;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class ProcessCampaignJob implements ShouldQueue
{
    use Queueable;

    /**
     * Campaign instance.
     */
    public Campaign $campaign;

    /**
     * Create job instance.
     */
    public function __construct(Campaign $campaign)
    {
        $this->campaign = $campaign;
    }

    /**
     * Execute job.
     */
    public function handle(): void
    {
        $this->campaign->update([
            'status' => 'processing',
            'started_at' => now(),
        ]);

        /*
        |--------------------------------------------------------------------------
        | Chunk contacts for scalability
        |--------------------------------------------------------------------------
        */

        $this->campaign->contacts()
            ->chunk(100, function ($contacts) {

                foreach ($contacts as $contact) {

                    SendCampaignEmailJob::dispatch(
                        $this->campaign,
                        $contact
                    );

                }

            });

        $this->campaign->update([
            'status' => 'completed',
            'completed_at' => now(),
        ]);
    }
}