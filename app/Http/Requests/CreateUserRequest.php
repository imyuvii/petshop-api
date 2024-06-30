<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateUserRequest extends FormRequest
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
            'first_name' => 'required|string|min:3|max:255',
            'last_name' => 'required|string|min:3|max:255',
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('users')->ignore($this->user()?->id),
            ],
            'password' => 'required|string|confirmed|min:8|max:255',
            'password_confirmation' => 'required|string|min:8|max:255',
            'avatar' => 'nullable|string|max:255',
            'address' => 'required|string|min:3|max:255',
            'phone_number' => 'required|string|min:3|max:100',
            'is_marketing' => 'boolean',
        ];
    }
}
