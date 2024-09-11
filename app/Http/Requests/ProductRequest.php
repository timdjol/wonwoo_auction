<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            'title' => 'required|min:3|max:255',
            //'description' => 'required|min:5',
            'category_id' => 'required',
            'brand_id' => 'required',
            'models_id' => 'required',
            'year' => 'required|min:4',
            'engine' => 'required|min:2',
            'transmission' => 'required|min:2',
            'oil' => 'required|min:2',
            'color' => 'required|min:2',
            'drive' => 'required|min:2',
            'parking' => 'required|min:1',
            'vin' => 'required|min:2',
            'mile' => 'required|min:2',
            'steer' => 'required|min:2',
            'volume' => 'required|min:2',
            //'lot' => 'required|min:2',
            'dateLot' => 'required|min:2',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg,webp,avif|max:2048',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg,webp,avif|max:2048',
            'price' => 'required|numeric|min:1',
            'price_sale' => 'required|numeric|min:1',
            'tengine' => 'required|min:2',
            'ttransmission' => 'required|min:2',
            'tsuspension' => 'required|min:2',
            'tsalon' => 'required|min:2',
            'tbrake' => 'required|min:2',
            'tbody' => 'required|min:2',
            'comment' => 'required|min:2',
            'power' => 'required',
            'state' => 'required',
            'type_own' => 'required',
            'size' => 'required',
            'type_wheel' => 'required',
            'count_place' => 'required',
            'salon_material' => 'required',
            'salon_color' => 'required',
            'class' => 'required',
            'stick' => 'required',
        ];
//        if($this->route()->named('products.update')){
//            $rules['code'] .= ',' . $this->route()->parameter('product')->id;
//        }
        return $rules;
    }

    public function messages()
    {
        return[
            'required'=> 'Поле :attribute обязательно для ввода',
            'min' => 'Поле :attribute должно иметь минимум :min символов',
            'image' => 'Загрузите изображение',
            'images.*' => 'Загрузите изображения',
            'mimes' => 'Изображение должно быть формата jpeg,png,jpg,gif,svg,webp',
            'max' => 'Размер изображения не должно превышать 2Мб',
            'unique' => 'Код должен быть уникальным'
        ];
    }
}
