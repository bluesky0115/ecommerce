<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfileFormRequest extends FormRequest
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
          'phone_number'=>['required','string','min:10','max:13'],
          'city'=>['required','string','min:2','max:30'],
          'street'=>['required','string','min:2','max:30']
        ];
    }
    public function messages()
    {
        return[
            'phone_number.required'=>'phone_number is required',
            'phone_number.required'=>'phone_number should be in character format',
            'phone_number.required'=>'phone_number length should be minimum of 10 characters',
            'phone_number.required'=>'phone_number length should be maximum of 13 characters',
            'city.required'=>'city is required',
            'city.required'=>'city should be in character format',
            'city.required'=>'city length should be minimum of 2 characters',
            'city.required'=>'city length should be maximum of 30 characters',
            'street.required'=>'street is required',
            'street.required'=>'street should be in character format',
            'street.required'=>'street length should be minimum of 2 characters',
            'street.required'=>'street length should be maximum of 30 characters'
        ];
    }
}
