<?php

namespace App\Http\Requests\Ticket;

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
            'name' => 'required',
            'cost' => 'numeric|min:0|max:1000000000',
            'special_validity' => 'nullable',
        ];
        $special_validity = $this->request->get('special_validity');
        if ($special_validity) {
            if ($special_validity == "amount") {
                $validation['amount'] = 'required|numeric|min:0|max:1000000000';
            } elseif ($special_validity == "date") {
                $validation['date'] = 'date_format:m-d-Y|after:tomorrow';
            }
        }
        return $validation;
    }
}
