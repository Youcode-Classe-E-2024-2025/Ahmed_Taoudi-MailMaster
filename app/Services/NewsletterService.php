<?php

namespace App\Services;

use App\Http\Requests\NewsletterRequest;
use App\Models\Newsletter;
use Illuminate\Support\Facades\Auth;

class NewsletterService
{
    // Get all newsletters
    public function getAll()
    {
        return Newsletter::all();
    }

    // Get a single newsletter by ID
    public function getById($id)
    {
        return Newsletter::find($id);
    }

    // Create a new newsletter
    public function create(NewsletterRequest $request)
    {

        $validatedData = $request->validated();

        $validatedData['user_id'] = Auth::id();

        $newsletter = Newsletter::create($validatedData);

        return $newsletter;
    }

    // Update an existing newsletter
    public function update($id, NewsletterRequest $request)
    {
        $newsletter = $this->getById($id);

        if (!$newsletter) {
            return null;
        }

        $validatedData = $request->validated(); 

        $newsletter->update($validatedData);

        return $newsletter;
    }

    // Delete a newsletter
    public function delete($id)
    {
        $newsletter = $this->getById($id);

        if (!$newsletter) {
            return null;
        }

        $newsletter->delete();
        return true;
    }
}
