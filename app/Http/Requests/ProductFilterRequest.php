<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductFilterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'page' => 'sometimes|integer',
            'limit' => 'sometimes|integer',
            'sortBy' => 'sometimes|string',
            'desc' => 'sometimes|boolean',
            'category' => 'sometimes|string',
            'price' => 'sometimes|integer',
            'title' => 'sometimes|string',
        ];
    }
}
