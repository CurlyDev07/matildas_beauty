<?php

namespace App\Http\Requests\RTS;

use Illuminate\Foundation\Http\FormRequest;

class StoreReturnRequest extends FormRequest
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
            'products' => 'required',
            'transaction_id' => 'required',
            'status' => 'required',
            'status' => 'required',
            'platform'=> 'required',
            // 'store'=> 'required',
            'pouch_size'=> 'required',
        ];
    }

    public function messages(){
        return [
            'transaction_id.required' => 'Please Type/Scan Tracking Number',
        ];
    }  
}
