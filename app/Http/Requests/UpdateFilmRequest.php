<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateFilmRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'poster_image' => 'sometimes|string|max:255',
            'preview_image' => 'sometimes|string|max:255',
            'background_image' => 'sometimes|string|max:255',
            'background_color' => 'sometimes|string|max:9',
            'video_link' => 'sometimes|string|max:255',
            'preview_video_link' => 'sometimes|string|max:255',
            'description' => 'sometimes|string|max:1000',
            'director' => 'sometimes|string|max:255',
            'starring' => 'sometimes|array',
            'genre' => 'sometimes|array',
            'run_time' => 'sometimes|integer',
            'released' => 'sometimes|integer',
            'imdb_id' => [
                'required',
                'string',
                'unique:films',
                'regex:/^(t{2})\d+$/'
            ],
            'status' => [
                'required',
                'string',
                Rule::in(['pending', 'on moderation', 'ready'])
            ],
        ];
    }
}
