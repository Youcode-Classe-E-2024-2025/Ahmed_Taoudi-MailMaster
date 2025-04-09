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
    /**
     * @OA\Get(
     *     path="/api/subscribers",
     *     summary="Get all subscribers",
     *     tags={"Subscribers"},
     *     security={{"sanctum":{}}},
     *     @OA\Response(
     *         response=200,
     *         description="List of all subscribers",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(ref="#/components/schemas/Subscriber")
     *         )
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Internal Server Error"
     *     )
     * )
     */
    public function index()
    {
        $subscribers = $this->subscriberService->getAll();
        return response()->json($subscribers);
    }

    // Get a single subscriber by ID
    /**
     * @OA\Get(
     *     path="/api/subscribers/{id}",
     *     summary="Get a single subscriber by ID",
     *     tags={"Subscribers"},
     *     security={{"sanctum":{}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="Subscriber ID",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="A single subscriber",
     *         @OA\JsonContent(ref="#/components/schemas/Subscriber")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Subscriber not found"
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Internal Server Error"
     *     )
     * )
     */
    public function show($id)
    {
        $subscriber = $this->subscriberService->getById($id);

        if (!$subscriber) {
            return response()->json(['message' => 'Subscriber not found'], 404);
        }

        return response()->json($subscriber);
    }

    // Create a new subscriber
    /**
     * @OA\Post(
     *     path="/api/subscribers",
     *     summary="Create a new subscriber",
     *     tags={"Subscribers"},
     *     security={{"sanctum":{}}},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/SubscriberRequest")
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Subscriber created successfully",
     *         @OA\JsonContent(ref="#/components/schemas/Subscriber")
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Invalid data"
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Internal Server Error"
     *     )
     * )
     */
    public function store(SubscriberRequest $request)
    {
        $subscriber = $this->subscriberService->create($request);

        return response()->json($subscriber, 201);
    }

    // Update an existing subscriber
    /**
     * @OA\Put(
     *     path="/api/subscribers/{id}",
     *     summary="Update an existing subscriber",
     *     tags={"Subscribers"},
     *     security={{"sanctum":{}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="Subscriber ID",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/SubscriberRequestUpdate")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Subscriber updated successfully",
     *         @OA\JsonContent(ref="#/components/schemas/Subscriber")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Subscriber not found"
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Internal Server Error"
     *     )
     * )
     */
    public function update(SubscriberRequestUpdate $request, $id)
    {
        $subscriber = $this->subscriberService->update($id, $request);

        if (!$subscriber) {
            return response()->json(['message' => 'Subscriber not found'], 404);
        }

        return response()->json($subscriber);
    }

    // Delete a subscriber
    /**
     * @OA\Delete(
     *     path="/api/subscribers/{id}",
     *     summary="Delete a subscriber",
     *     tags={"Subscribers"},
     *      security={{"sanctum":{}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="Subscriber ID",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Subscriber deleted successfully",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="message", type="string")
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Subscriber not found"
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Internal Server Error"
     *     )
     * )
     */
    public function destroy($id)
    {
        $deleted = $this->subscriberService->delete($id);

        if (!$deleted) {
            return response()->json(['message' => 'Subscriber not found'], 404);
        }

        return response()->json(['message' => 'Subscriber deleted successfully']);
    }
}
