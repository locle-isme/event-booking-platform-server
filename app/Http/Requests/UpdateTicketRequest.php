<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTicketRequest extends FormRequest
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
        $end_point = [
            'name' => 'required',
            'cost' => 'numeric|min:0|max:1000000000'
        ];

        $special_validity = $this->request->get('special_validity');
        if ($special_validity) {
            if ($special_validity == "amount") {
                $end_point['amount'] = 'required|numeric|min:0|max:1000000000';
            } elseif ($special_validity == "date") {
                $end_point['date'] = 'date_format:Y-m-d|after:tomorrow';
            }
        }
        return $end_point;
    }
}
