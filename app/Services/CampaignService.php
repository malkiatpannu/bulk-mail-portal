<?php

namespace App\Services;

use App\Jobs\ProcessCampaignJob;
use App\Models\Campaign;

class CampaignService
{
    /**
     * Dispatch campaign.
     */
    public function dispatch(Campaign $campaign): void
    {
        ProcessCampaignJob::dispatch($campaign);
    }
}