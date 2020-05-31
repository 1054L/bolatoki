<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SavePlayerRequest extends FormRequest
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
            'name' => 'required',
            'surname' => 'required',
            'club' => 'required',
            'email' => 'required',
            'phone' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => __('Name is required'),
            'surname.required' => __('Surname is required'),
            'club.required' => __('Club is required'),
            'email.required' => __('Email is required'),
            'phone.required' => __('Phone is required'),
        ];
    }
}
