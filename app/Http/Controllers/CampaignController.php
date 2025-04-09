<?php

namespace App\Http\Controllers;

use App\Http\Requests\CampaignRequest;
use App\Models\Campaign;
use App\Services\CampaignService;
use Illuminate\Http\Request;

class CampaignController extends Controller
{
    protected $campaignService;

    public function __construct(CampaignService $campaignService)
    {
        $this->campaignService = $campaignService;
    }

    // Get all campaigns
    public function index()
    {
        $campaigns = $this->campaignService->getAll();
        return response()->json($campaigns);
    }

    // Get a single campaign by ID
    public function show($id)
    {
        $campaign = $this->campaignService->getById($id);

        if (!$campaign) {
            return response()->json(['message' => 'Campaign not found'], 404);
        }

        return response()->json($campaign);
    }

    // Create a new campaign
    public function store(CampaignRequest $request)
    {
        $campaign = $this->campaignService->create($request);

        return response()->json($campaign, 201);
    }

    // Update an existing campaign
    public function update(CampaignRequest $request, $id)
    {
        $campaign = $this->campaignService->update($id, $request);

        if (!$campaign) {
            return response()->json(['message' => 'Campaign not found'], 404);
        }

        return response()->json($campaign);
    }

    // Delete a campaign
    public function destroy($id)
    {
        $deleted = $this->campaignService->delete($id);

        if (!$deleted) {
            return response()->json(['message' => 'Campaign not found'], 404);
        }

        return response()->json(['message' => 'Campaign deleted successfully']);
    }
}
