<?php

namespace App\Http\Requests\Doctors;

use Illuminate\Foundation\Http\FormRequest;

class SendDrugRequest extends FormRequest
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
            // "drug"=>'required',
            // "dose"=>'required',
            // "dosage_form"=>'required',
            // "frequency"=>'required',
            // "duration"=>'required',
            // "quantity"=>'required'
        ];
    }
}
