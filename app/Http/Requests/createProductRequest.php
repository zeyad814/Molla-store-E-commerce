<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class createProductRequest extends FormRequest
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
                'product_code'=>'nullable|unique:products,product_code',
                'product_price'=>'required|numeric|min:0',
                'product_discount'=>'min:0|max:100',
                'final_price'=>'required|numeric|min:0',
                'description'=>"required|string",
                'sku'=>'nullable|unique:products,sku',
                'stock'=>'required|numeric|min:0|max:200',
                'meta_title'=>'',
                'main_image'=>'required|image|mimes:png,jpg,svg|mimetypes:image/jpeg,image/png',
                'image_1'=>'image|mimes:png,jpg,svg',
                'image_2'=>'image|mimes:png,jpg,svg',
                'image_3'=>'image|mimes:png,jpg,svg',
                'is_featured'=>'required|in:yes,no',
                'status'=>'required|in:1,0',
        ];
    }
    public function message(): array
    {
        return [
                'category_id.required'=>'category is required',
                'brand_id.required'=>'brand is required',
        ];
    }
}
