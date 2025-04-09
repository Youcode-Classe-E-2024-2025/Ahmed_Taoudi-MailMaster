<?php

namespace App\Http\Controllers;

use App\Services\NewsletterService;
use App\Http\Requests\NewsletterRequest;
use Illuminate\Http\Request;

class NewsletterController extends Controller
{
    protected $newsletterService;

    public function __construct(NewsletterService $newsletterService)
    {
        $this->newsletterService = $newsletterService;
    }

    /**
     * @OA\Get(
     *     path="/api/newsletters",
     *     summary="Get all newsletters",
     *     tags={"Newsletters"},
     *     security={{"sanctum":{}}},
     *     @OA\Response(
     *         response=200,
     *         description="List of newsletters",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(ref="#/components/schemas/Newsletter")
     *         )
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Internal server error"
     *     )
     * )
     */

    public function index()
    {
        $newsletters = $this->newsletterService->getAll();
        return response()->json($newsletters);
    }
    /**
     * @OA\Get(
     *     path="/api/newsletters/{id}",
     *     summary="Get a single newsletter by ID",
     *     tags={"Newsletters"},
     *     security={{"sanctum":{}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="The ID of the newsletter",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Newsletter details",
     *         @OA\JsonContent(ref="#/components/schemas/Newsletter")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Newsletter not found"
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Internal server error"
     *     )
     * )
     */

    public function show($id)
    {
        $newsletter = $this->newsletterService->getById($id);

        if (!$newsletter) {
            return response()->json(['message' => 'Newsletter not found'], 404);
        }

        return response()->json($newsletter);
    }
    /**
     * @OA\Post(
     *     path="/api/newsletters",
     *     summary="Create a new newsletter",
     *     tags={"Newsletters"},
     *     security={{"sanctum":{}}},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/NewsletterRequest")
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Newsletter created successfully",
     *         @OA\JsonContent(ref="#/components/schemas/Newsletter")
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Invalid input"
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Internal server error"
     *     )
     * )
     */

    public function store(NewsletterRequest $request)
    {
        $newsletter = $this->newsletterService->create($request);

        return response()->json($newsletter, 201);
    }
    /**
     * @OA\Put(
     *     path="/api/newsletters/{id}",
     *     summary="Update an existing newsletter",
     *     tags={"Newsletters"},
     *     security={{"sanctum":{}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="The ID of the newsletter",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/NewsletterRequest")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Newsletter updated successfully",
     *         @OA\JsonContent(ref="#/components/schemas/Newsletter")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Newsletter not found"
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Invalid input"
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Internal server error"
     *     )
     * )
     */

    public function update(NewsletterRequest $request, $id)
    {
        $newsletter = $this->newsletterService->update($id, $request);

        if (!$newsletter) {
            return response()->json(['message' => 'Newsletter not found'], 404);
        }

        return response()->json($newsletter);
    }
    /**
     * @OA\Delete(
     *     path="/api/newsletters/{id}",
     *     summary="Delete a newsletter",
     *     tags={"Newsletters"},
     *     security={{"sanctum":{}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="The ID of the newsletter",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Newsletter deleted successfully"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Newsletter not found"
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Internal server error"
     *     )
     * )
     */

    public function destroy($id)
    {
        $deleted = $this->newsletterService->delete($id);

        if (!$deleted) {
            return response()->json(['message' => 'Newsletter not found'], 404);
        }

        return response()->json(['message' => 'Newsletter deleted successfully']);
    }
}
