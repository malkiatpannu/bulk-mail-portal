<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCampaignRequest;
use App\Models\Campaign;
use App\Models\Contact;
use App\Models\Template;
use App\Services\CampaignService;
use Illuminate\Http\Request;

class CampaignController extends Controller
{
    /**
     * List campaigns.
     */
    public function index()
    {
        $campaigns = Campaign::with('template')
            ->latest()
            ->paginate(10);

        return view('campaigns.index', compact('campaigns'));
    }

    /**
     * Create form.
     */
    public function create()
    {
        $templates = Template::latest()->get();

        $contacts = Contact::latest()->get();

        return view('campaigns.create', compact(
            'templates',
            'contacts'
        ));
    }

    /**
     * Store campaign.
     */
    public function store(
        StoreCampaignRequest $request,
        CampaignService $campaignService
    ) {

        $campaign = Campaign::create([
            'name' => $request->name,
            'template_id' => $request->template_id,
            'status' => $request->scheduled_at
                ? 'scheduled'
                : 'processing',
            'scheduled_at' => $request->scheduled_at,
        ]);

        $campaign->contacts()
            ->sync($request->contacts);

        if (!$request->scheduled_at) {
            $campaignService->dispatch($campaign);
        }

        return redirect()
            ->route('campaigns.index')
            ->with('success', 'Campaign created successfully.');
    }

    /**
     * Campaign details.
     */
    public function show(Campaign $campaign)
    {
        $campaign->load([
            'template',
            'contacts',
            'emailLogs.contact',
        ]);

        return view('campaigns.show', compact('campaign'));
    }
}