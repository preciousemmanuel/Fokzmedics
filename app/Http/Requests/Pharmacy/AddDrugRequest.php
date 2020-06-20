<?php

namespace App\Http\Requests\Pharmacy;

use Illuminate\Foundation\Http\FormRequest;

class AddDrugRequest extends FormRequest
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
            "generic_name"=>"required",
            "trade_name"=>"required",
            "quantity"=>"required|integer",
            "price"=>"required"
        ];
    }
}
