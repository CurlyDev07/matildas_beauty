<?php

namespace App\Http\Requests\StoresMetrics;

use Illuminate\Foundation\Http\FormRequest;

class StoresMetricsCreateRequest extends FormRequest
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
            "date" => 'required',
            "sales" => 'required|integer',
            "orders" => 'required|integer',
            "visitors" => 'required|integer',
            "conversion_rate" => 'required|regex:/^\d+(\.\d{1,2})?$/',
        ];
    }
}
