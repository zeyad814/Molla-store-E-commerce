<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class registerRequest extends FormRequest
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
            'email' => "required|email",
            'name' => "required|max:40|min:10|unique:users,email",
            'password' => "required|confirmed|min:6",
            'phone' => "required|starts_with:010,011,012,015|size:11",
        ];
    }
    public function messages()
    {
        return [
            'name.min' => 'entre your full name',
            'phone.start_with' => 'the phone number must start with 010 or 011 or 012 or 015',
            'phone.size' => 'the size of phone must be 11 numbers',
        ];
    }
}
