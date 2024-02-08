<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class createCtegoryRequest extends FormRequest
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
            'category_name'=>"required",
            'category_image'=>"image|mimes:png,jpg,jpeg,gif|mimetypes:image/jpeg,image/png",
            'description'=>"nullable|string",
            'category_discount'=>"nullable",
            'status'=>"required|in:0,1",
            'url'=>"nullable|string",
        ];
    }
}
