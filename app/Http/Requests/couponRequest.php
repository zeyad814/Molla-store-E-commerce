<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class couponRequest extends FormRequest
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
            'code'=>'required|unique:discount_coupons,code',
            'name'=>'nullable|string|min:5|max:25',
            'status'=>'required|in:1,0',
            'max_uses'=>'required',
            'type'=>'required|in:fixed,percent',
            'starts_at'=>'required',
            'expires_at'=>'required',
            'description'=>'nullable|string',
            'discount_amount'=>'required|min:1|max:500',
        ];
    }
}
