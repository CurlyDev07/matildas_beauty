<?php

namespace App\Http\Requests\FbAds;

use Illuminate\Foundation\Http\FormRequest;

class StoreFbAdsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "full_name" => "required",
            "phone_number" => "required|digits:11",
            "address" => "required",
            "province" => "required",
            "city" => "required",
            "barangay" => "required",
            "promo" => "required",
        ];
    }

    public function messages(){
        return [
            // 'phone_number.min' => 'Phone number is incomplete',
            // 'phone_number.max' => 'Phone number is morethan 11 digits',
        ];
    }   
}
