<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'required|max:50',
            'price' => 'required'
        ];
    }

    public function messages()
{
    return [
        'name.required' => 'Kitabın adı zorunludur',
        'price.required' => 'Kitabın fiyatı zorunludur',
        'name.max' => 'Kitabın ismi 50 karakterden fazla olamaz'
    ];
}
}
