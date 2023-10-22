<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends FormRequest
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
            'email' => [Rule::unique('users')->ignore(Auth::user()), 'required', 'email'],
            'password' => 'sometimes|string|min:8|confirmed',
            'password_confirmation' => 'sometimes|required_if:password,true',
            'name' => 'required|string|max:255',
            'file' => 'sometimes|image|max:10000',
        ];
    }
}
