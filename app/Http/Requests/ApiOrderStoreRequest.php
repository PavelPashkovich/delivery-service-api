<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ApiOrderStoreRequest extends ApiRequest
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
            'status' => 'required',
            'need_delivery' => 'required|bool',
            'delivery_period' => 'required|date',
            'user_id' => 'required|exists:users,id|integer',
            'product_ids' => 'required|array',
            'product_ids.*' => 'required|integer|exists:products,id'
        ];
    }
}
