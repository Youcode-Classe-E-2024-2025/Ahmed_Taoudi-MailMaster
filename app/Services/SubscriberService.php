<?php

namespace App\Services;

use App\Models\Subscriber;
use App\Http\Requests\SubscriberRequest;
use App\Http\Requests\SubscriberRequestUpdate;

class SubscriberService
{
    // Get all subscribers
    public function getAll()
    {
        return Subscriber::active()->get();
    }

    // Get a single subscriber by ID
    public function getById($id)
    {
        return Subscriber::find($id);
    }

    // Create a new subscriber
    public function create(SubscriberRequest $request)
    {
        $validatedData = $request->validated();

        return Subscriber::create($validatedData);
    }

    // Update an existing subscriber
    public function update($id, SubscriberRequestUpdate $request)
    {
        $subscriber = $this->getById($id);

        if (!$subscriber) {
            return null; 
        }

        $validatedData = $request->validated();

        $subscriber->update($validatedData);
        return $subscriber;
    }

    // Delete a subscriber
    public function delete($id)
    {
        $subscriber = $this->getById($id);

        if (!$subscriber) {
            return null; 
        }

        $subscriber->delete();
        return true;
    }
}
