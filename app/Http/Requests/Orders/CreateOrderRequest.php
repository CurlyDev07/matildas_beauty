<?php

namespace App\Http\Requests\Orders;

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
            // 'products'=> 'required',
            // 'products.product_id'=> 'required',
            // 'price'=> 'required|integer',
            // 'quantity'=> 'required|integer',
            // 'total'=> 'required|integer',
            
            'date' => 'required',
            'package_qty' => 'required',
            // 'first_name' => 'required',
            // 'sold_from'=> 'required|integer',
            // 'payment_method'=> 'required|integer',
        ];
    }

    public function messages(){
        return [
            // 'products.required' => 'Please choose a <b>Product</b>',
            // 'products.product_id.required' => 'Please choose a <b>Product</b>',
            'date.required' => 'Please select a <b>Date</b>',
            'package_qty.required' => 'The <b>Package Qty</b> field is required.',
        ];
    }  
}
