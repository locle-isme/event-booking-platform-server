<?php

namespace App\Http\Requests\Attendee;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'lastname' => 'required|min:2|max:16',
            'firstname' => 'required|min:2|max:16',
            'username' => 'required|unique:attendees|min:6|max:32',
            'email' => 'email|unique:attendees',
            'password' => 'required|min:8|max:64'
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json(['errors' => $validator->errors()], 422));
    }
}
