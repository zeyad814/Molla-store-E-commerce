<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class cartRequest extends FormRequest
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
            'product_qty'=>'required|max:15|min:1',
            // 'product_id'=>'required|integer|exists:products,id',
            // 'price'=>'required',
            // 'image'=>'required',
        ];
    }
}
