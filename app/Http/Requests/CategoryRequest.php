<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        $rules = [
            //'code' => 'required|min:3|max:255|unique:categories,code',
            'title' => 'required|min:3|max:255',
            //'description' => 'required|min:5|max:255'
        ];
//        if($this->route()->named('categories.update')){
//            $rules['code'] .= ',' . $this->route()->parameter('category')->id;
//        }
       return $rules;
    }

    public function messages()
    {
        return[
          'required'=>'Поле :attribute обязательно для ввода',
            'min' => 'Поле :attribute должно иметь минимум :min символов',
            'code.min' => 'Поле код должно содержать не менее :min символов'
        ];
    }
}
