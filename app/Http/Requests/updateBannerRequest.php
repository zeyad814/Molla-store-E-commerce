<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class updateBannerRequest extends FormRequest
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
            'image'=>'nullable|image|mimes:png,jpg,svg,jpeg',
            'title'=>'required|max:100',
            'sort'=>'nullable|numeric',
            'type'=>'required|in:slider,demo_1,demo_2,demo_3,demo_4',
            'alt'=>'nullable',
            'link'=>'nullable',
        ];
    }
}
