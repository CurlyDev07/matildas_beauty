<?php

namespace App\Http\Requests\Products;

use Illuminate\Foundation\Http\FormRequest;

class UploadProductsRequest extends FormRequest
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
            'title' => 'required|min:2|max:200',
            // 'description' => 'required',
            // 'short_description' => 'required',
            'price' => 'required|integer',
            'sku' => 'required',
            'qty' => 'required|integer',
            'images' => 'required'
        ];
    }

    public function messages(){
        return [
            'title.required' => 'The <b>Title</b> is required',
            'description.required'  => 'The <b>Description</b> is required',
            'price.required'  => 'The <b>Price</b> is required',
            'qty.required'  => 'The <b>Quantity</b> is required',
            'images.required'  => 'The <b>Images</b> is required',
        ];
    }
}
