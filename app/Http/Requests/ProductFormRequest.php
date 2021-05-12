<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductFormRequest extends FormRequest
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
            'name'=>['required','string','min:3','max:20'],
            'category'=>['required'],
            'cost'=>['required'],
            'photo'=>['required','image'],
            'description'=>['max:200']
        ];
    }
    public function messages()
    {
      return [
          'name.required'=>'product name is required',
          'name.string'=>'product name should be characters',
          'name.required'=>'product name should be minimum of 3 characters',
          'name.required'=>'product name should be maximum of 20  characters',
          'category.required'=>'product category is required',
          'cost.required'=>'product cost is required',
          'photo.required'=>'product picture is required',
          'photo.image'=>'product picture should be an image',
          'description.max'=>'product description should be less than 200 characters',
      ];
    }
}
