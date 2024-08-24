<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NewHallSeatRequest extends FormRequest
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
            'seats' => ['required','array'],
            'seats.*.seat_id' => ['required' , 'Exists:seats,id'],
            'seats.*.seat_count' => ['required' , 'integer' ,'gte:100' , 'lte:100000'],
            'seats.*.unit_cost' => ['required' , 'integer' ,'min:200000'],
        ];
    }
}
