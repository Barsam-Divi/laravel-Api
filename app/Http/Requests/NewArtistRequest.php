<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NewArtistRequest extends FormRequest
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
            'name' => ['required' , 'min:2' ,'max:220'],
            'category_id' => ['required' , 'exists:categories,id'],
            'avatar' => ['required' ,'mimes:jpg,svg,jpeg,png,mpeg' , 'min:1', 'max:1024'],
            'background' => ['required', 'mimes:jpg,svg,jpeg,png,mpeg' ,'min:1', 'max:3024']
        ];
    }
}
