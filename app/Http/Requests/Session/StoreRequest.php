<?php

namespace App\Http\Requests\Session;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $validation = [
            'title' => 'required',
            'type' => 'required',
            'speakers' => 'required',
            'room' => 'required',
            'start' => 'required|date_format:Y-m-d H:i|after:tomorrow',
            'end' => 'required|date_format:Y-m-d H:i|after:start',
            'description' => 'required'
        ];
        if ($this->request->get('type') == 'workshop') {
            $validation['cost'] = 'required|numeric|min:0|max:1000000000';
        }
        return $validation;
    }
}
