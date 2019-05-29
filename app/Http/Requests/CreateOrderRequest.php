<?php

namespace App\Http\Requests;

use AndreasPabst\RequestValidation\RequestAbstract;

class CreateOrderRequest extends RequestAbstract
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
            'products' => 'required|array',
            'shipping_address' => 'required',
            'products.*.id' => 'required|numeric',
            'products.*.price' => 'required|numeric',
            'products.*.quantity' => 'required|numeric'
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array
     */
    public function messages()
    {
        return [
            //
        ];
    }
}
