<?php

namespace App\Http\Requests\Patients;

use Illuminate\Foundation\Http\FormRequest;

class BookDoctorRequest extends FormRequest
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
            'dateBook'=>'required',
            'timeBook'=>'required'
        ];
    }
}
