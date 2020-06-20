<?php

namespace App\Http\Requests\Pharmacy;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProfileRequest extends FormRequest
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
            "fullname"=>"required",
            "phone"=>"required",
            "business_name"=>"required",
            "licence_number"=>"required",
            "supretendent_name"=>"required",
            "consult_hour"=>"required"

        ];
    }
}
