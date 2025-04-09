<?php

namespace App\Http\Controllers;

use App\Services\SubscriberService;
use App\Http\Requests\SubscriberRequest;
use App\Http\Requests\SubscriberRequestUpdate;

class SubscriberController extends Controller
{
    protected $subscriberService;

    public function __construct(SubscriberService $subscriberService)
    {
        $this->subscriberService = $subscriberService;
    }

    // Get all subscribers
    public function index()
    {
        $subscribers = $this->subscriberService->getAll();
        return response()->json($subscribers);
    }

    // Get a single subscriber by ID
    public function show($id)
    {
        $subscriber = $this->subscriberService->getById($id);

        if (!$subscriber) {
            return response()->json(['message' => 'Subscriber not found'], 404);
        }

        return response()->json($subscriber);
    }

    // Create a new subscriber
    public function store(SubscriberRequest $request)
    {
        $subscriber = $this->subscriberService->create($request);

        return response()->json($subscriber, 201);
    }

    // Update an existing subscriber
    public function update(SubscriberRequestUpdate $request, $id)
    {
        $subscriber = $this->subscriberService->update($id, $request);

        if (!$subscriber) {
            return response()->json(['message' => 'Subscriber not found'], 404);
        }

        return response()->json($subscriber);
    }

    // Delete a subscriber
    public function destroy($id)
    {
        $deleted = $this->subscriberService->delete($id);

        if (!$deleted) {
            return response()->json(['message' => 'Subscriber not found'], 404);
        }

        return response()->json(['message' => 'Subscriber deleted successfully']);
    }
}
