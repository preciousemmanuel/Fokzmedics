<?php

namespace App\Http\Requests\Doctors;

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
            "fullname"=>'required',
            "phone"=>'required',
            "specialization_id"=>"required",
            "consult_type_id"=>'required',
            "consulting_fee"=>'required'
        ];
    }
}
