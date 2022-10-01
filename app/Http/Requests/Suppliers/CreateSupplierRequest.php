<?php

namespace App\Http\Requests\Suppliers;

use Illuminate\Foundation\Http\FormRequest;

class CreateSupplierRequest extends FormRequest
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
            "name" => 'required',
            "surname" => 'required',
            "phone_number" => 'required',
            "province" => 'required',
            "city" => 'required',
            "barangay" => 'required',
            "complete_address" => 'required',
            "social_media" => 'required',
            "social_media_link" => 'required',
            "bank" => 'required',
            "contact_number" => 'required',
            "account_name" => 'required',
            "account_number" => 'required'
        ];
    }
}
