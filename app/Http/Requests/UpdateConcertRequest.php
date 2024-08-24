<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateConcertRequest extends FormRequest
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
            'artist_id' => ['nullable' , 'exists:artists,id'],
            'hall_id' => ['nullable' , 'exists:halls,id'],
            'description' => ['nullable' , 'min:5'],
            'title' => ['nullable' , 'min:2' ,'max:50'],
            'started_at' => ['nullable' , 'date' , 'before:end_at'],
            'end_at' => ['nullable' , 'date' , 'after:started_at'],
            'published' => ['nullable']
        ];
    }
}
