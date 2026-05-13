<?php

namespace App\Console\Commands;

use App\Models\Campaign;
use App\Services\CampaignService;
use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;

#[Signature('campaigns:process-scheduled')]
#[Description('Process scheduled campaigns')]
class ProcessScheduledCampaigns extends Command
{
    /**
     * Execute the console command.
     */
    public function handle(
        CampaignService $campaignService
    ): void {

        Campaign::query()
            ->where('status', 'scheduled')
            ->where('scheduled_at', '<=', now())
            ->chunk(20, function ($campaigns)
                use ($campaignService) {

                foreach ($campaigns as $campaign) {

                    $campaign->update([
                        'status' => 'processing',
                    ]);

                    $campaignService->dispatch($campaign);
                }

            });

        $this->info('Scheduled campaigns processed.');
    }
}
