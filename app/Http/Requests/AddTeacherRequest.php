<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Password;

class AddTeacherRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // check user by certain condition and return bool
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        /* 
        * Validate payload body:
        * length / size of item eg: 8 character
        * data type of item eg: string, numeric
        * data format of item eg: date, regex
        */
        return [
            // pipe form
            'name' => 'required|string|max:255',
            // array form
            'secret' => [
                'required',
                'string',
                'alpha_num',
                'min:5'
            ],
        ];
    }

    public function messages()
    {
        return [
            'name.string' => "Hey, your name is UN acceptable !!"
        ];
    }
}
