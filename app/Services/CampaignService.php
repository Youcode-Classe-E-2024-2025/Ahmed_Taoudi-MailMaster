<?php

namespace App\Services;

use App\Models\Campaign;
use App\Http\Requests\CampaignRequest;

class CampaignService
{
    // Get all campaigns
    public function getAll()
    {
        return Campaign::with(['user', 'newsletter'])->get();
    }

    // Get a single campaign by ID
    public function getById($id)
    {
        return Campaign::with(['user', 'newsletter'])->find($id);
    }

    // Create a new campaign
    public function create(CampaignRequest $request)
    {

        $validatedData = $request->validated();


        return Campaign::create($validatedData);
    }

    // Update an existing campaign
    public function update($id, CampaignRequest $request)
    {
        $campaign = $this->getById($id);

        if (!$campaign) {
            return null;
        }

        $validatedData = $request->validated();

        $campaign->update($validatedData);
        return $campaign;
    }

    // Delete a campaign
    public function delete($id)
    {
        $campaign = $this->getById($id);

        if (!$campaign) {
            return null;
        }

        $campaign->delete();
        return true;
    }
}
