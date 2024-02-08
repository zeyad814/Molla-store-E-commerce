<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class updateProductRequest extends FormRequest
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
                'category_id'=>'required',
                'brand_id'=>'required',
                'product_name'=>'required|string',
                'product_code'=>'nullable|string',
                'product_price'=>'required|numeric|min:0',
                'product_discount'=>'min:0|max:100',
                'final_price'=>'required|numeric|min:0',
                'main_image'=>'image|mimes:png,jpg,svg|mimetypes:image/jpeg,image/png',
                'image_1'=>'image|mimes:png,jpg,svg',
                'image_2'=>'image|mimes:png,jpg,svg',
                'description'=>"required|string",
                'sku'=>'nullable|string',
                'is_bestseller'=>'nullable|in:yes,no',
                'stock'=>'required|numeric|min:0|max:200',
                'is_featured'=>'required|in:yes,no',
                'status'=>'required|in:1,0',
        ];
    }
    public function message(): array
    {
        return [
                'category_id.required'=>'category is required',
                'brand_id.required'=>'brand is required',
                'product_video.max'=>'The product video field must not be greater than 10 MB.'
        ];
    }
}
