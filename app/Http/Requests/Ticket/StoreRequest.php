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
        $validRules = [
            'name' => 'required',
            'cost' => 'numeric|min:0|max:1000000000',
            'special_validity' => 'nullable',
        ];
        $specialValidity = $this->request->get('special_validity');
        $specialValidityRules = [
            'amount' => 'required|numeric|min:0|max:1000000000',
            'date' => 'date_format:Y-m-d|after:tomorrow',
        ];
        if (!empty($specialValidity) && in_array($specialValidity, array_keys($specialValidityRules))) {
            $validRules[$specialValidity] = $specialValidityRules[$specialValidity];
        }
        return $validRules;
    }
}
