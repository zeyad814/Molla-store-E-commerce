<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class updateDetailsRequest extends FormRequest
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
            'name' => 'required|max:255|min:12',
            'phone' => 'required|size:11|starts_with:010,011,012,015',
            'image' => 'required|image|mimes:png,jpg,jpeg'
        ];

    }
    public function message(): array
    {
        return [
            'phone.start_with' => 'the phone number must start with 010 or 011 or 012 or 015 ',
            'name.min' => 'please enter your full name'
        ];

    }
}
