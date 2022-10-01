<?php

namespace App\Http\Requests\Shopee;

use Illuminate\Foundation\Http\FormRequest;

class CreateOrderRequest extends FormRequest
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
            'store' => 'required',
            // 'file' => 'required|mimes:xlsx,xls,xlr,xlw,xla,xlam,xml,xml,xlt,xltm,xltx,xlsb,xlsm'
        ];
    }

    public function messages(){
        return [
            'file.mimes' => 'The file type must be .xlsx',
        ];
    }
}
