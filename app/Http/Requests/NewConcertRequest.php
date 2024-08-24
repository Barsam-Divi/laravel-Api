<?php

namespace App\Http\Requests;

use App\Http\Resources\HallResource;
use Illuminate\Foundation\Http\FormRequest;

class NewConcertRequest extends FormRequest
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
            'artist_id' => ['required' , 'exists:artists,id'],
            'hall_id' => ['required' , 'exists:halls,id'],
            'description' => ['required' , 'min:5'],
            'title' => ['required' , 'min:2' ,'max:50'],
            'started_at' => ['required' , 'date' , 'before:end_at'],
            'end_at' => ['required' , 'date' , 'after:started_at'],
            'published' => ['nullable']
        ];
    }
}
