<?php

namespace App\Http\Requests\Withdrawal;

use Illuminate\Foundation\Http\FormRequest;

class WithdrawalCreateRequest extends FormRequest
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
            "store_id" => 'required',
            "date" => 'required',
            "amount" => 'required|regex:/^\d+(\.\d{1,2})?$/',
        ];
    }
}
