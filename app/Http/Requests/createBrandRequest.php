<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class createBrandRequest extends FormRequest
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
            'brand_name'=>"required|min:3|max:25",
            'brand_discount'=>"nullable|numeric|max:100",
            'description'=>"nullable|string",
            'brand_logo'=>"image|mimes:png,jpg,jpeg,gif|mimetypes:image/jpeg,image/png",
            'status'=>"required|in:1,0"
        ];
    }
}
