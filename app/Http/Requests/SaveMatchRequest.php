<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SaveMatchRequest extends FormRequest
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
            'date' => 'required',
            'court_id' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'date.required' => __('Matching date is required'),
            'court_id.required' => __('Matching court is required')
        ];
    }
}
