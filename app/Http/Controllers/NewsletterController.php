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

    public function index()
    {
        $newsletters = $this->newsletterService->getAll();
        return response()->json($newsletters);
    }

    public function show($id)
    {
        $newsletter = $this->newsletterService->getById($id);

        if (!$newsletter) {
            return response()->json(['message' => 'Newsletter not found'], 404);
        }

        return response()->json($newsletter);
    }

    public function store(NewsletterRequest $request)
    {
        $newsletter = $this->newsletterService->create($request);

        return response()->json($newsletter, 201);
    }

    public function update(NewsletterRequest $request, $id)
    {
        $newsletter = $this->newsletterService->update($id, $request);

        if (!$newsletter) {
            return response()->json(['message' => 'Newsletter not found'], 404);
        }

        return response()->json($newsletter);
    }

    public function destroy($id)
    {
        $deleted = $this->newsletterService->delete($id);

        if (!$deleted) {
            return response()->json(['message' => 'Newsletter not found'], 404);
        }

        return response()->json(['message' => 'Newsletter deleted successfully']);
    }
}
