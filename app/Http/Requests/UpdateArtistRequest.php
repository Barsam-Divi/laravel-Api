<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateArtistRequest extends FormRequest
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
            'name' => ['nullable' , 'min:2' ,'max:220'],
            'category_id' => ['nullable' , 'exists:categories,id'],
            'avatar' => ['nullable' , 'mimes:jpg,svg,jpeg,png,mpeg' ,'min:1', 'max:3024' ],
            'background' => ['nullable' ,  'mimes:jpg,svg,jpeg,png,mpeg' ,'min:1', 'max:3024']
        ];
    }
}
