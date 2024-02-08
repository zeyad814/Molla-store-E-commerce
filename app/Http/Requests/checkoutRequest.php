<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class checkoutRequest extends FormRequest
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
            'email'=>'email|required',
            'address'=>'required',
            'postal_code'=>'required',
            'town'=>'required|string',
            'state'=>'required|string',
            'first_name'=>'required|string',
            'last_name'=>'required|string',
            'phone'=>'required|starts_with:010,011,012,015|size:11',
            'coupon_code'=>'nullable|string',
            'notes'=>'nullable|string',
        ];
    }
}
