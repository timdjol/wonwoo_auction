<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
        return [
            'name' => ['required', 'string'],
            'email' => ['required', 'string', 'email'],
            'phone' => ['required', 'string'],
            'address' => ['required', 'string'],
            'passport_inn' => ['required', 'string', 'max:30'],
            'passport_id' => ['required', 'string', 'max:30'],
            //'bank' => ['string'],
            //'bik' => ['integer'],
            //'account' => ['integer'],
            'password' => ['required', 'string'],
            'password_confirmation' => ['required', 'string'],
            'agreement' => ['required'],
        ];
    }

    public function messages()
    {
        return[
            'required'=>'Поле :attribute обязательно для ввода',
        ];
    }
}
