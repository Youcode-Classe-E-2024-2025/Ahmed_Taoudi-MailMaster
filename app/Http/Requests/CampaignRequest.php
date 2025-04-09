<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CampaignRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'newsletter_id' => 'required|exists:newsletters,id', 
            'subject' => 'required|string|max:255',
            'status' => 'required|in:en préparation,envoyée,échouée', 
            'sent_at' => 'nullable|date', 
        ];
    }
}
