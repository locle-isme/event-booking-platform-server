<?php

namespace App\Http\Requests\Speaker;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required',
            'birthday' => 'required|date_format:Y-m-d|before:today',
            'social_linking' => 'nullable|url',
            'avatar' => 'nullable|mimes:jpeg,png,jpg,gif',
            'description' => 'required'
        ];
    }
}
