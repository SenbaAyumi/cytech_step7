<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'product_name' => 'required',
            'company_id' => 'required',
            'price' => 'required | numeric',
            'stock' => 'required | numeric',
        ];
    }

    public function messages() {
        return [
            'product_name.required' => ':商品名は必須項目です。',
            'company_id.required' => ':会社名は必須項目です。',
            'price.required' => ':価格は必須項目です。',
            'price.numeric' => ':価格は半角数字で入力してください。',
            'stock.required' => ':在庫数は必須項目です。',
            'stock.numeric' => ':価格は半角数字で入力してください。',
        ];
    }
}
