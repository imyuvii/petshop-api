<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

/**
 * @OA\Schema(
 *     schema="CreateUserRequest",
 *     type="object",
 *     required={"first_name", "last_name", "email", "password", "password_confirmation", "address", "phone_number"},
 *     @OA\Property(property="first_name", type="string", example="John"),
 *     @OA\Property(property="last_name", type="string", example="Doe"),
 *     @OA\Property(property="email", type="string", format="email", example="user@example.com"),
 *     @OA\Property(property="password", type="string", example="password"),
 *     @OA\Property(property="password_confirmation", type="string", example="userpassword"),
 *     @OA\Property(property="avatar", type="string", nullable=true, example="uuid"),
 *     @OA\Property(property="address", type="string", example="123 Main St"),
 *     @OA\Property(property="phone_number", type="string", example="+1234567890"),
 *     @OA\Property(property="is_marketing", type="integer", enum={0, 1}, example=0)
 * )
 */
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
