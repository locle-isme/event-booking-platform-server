<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSessionRequest extends FormRequest
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
            'title' => 'required',
            'type' => 'required',
            'speakers' => 'required',
            'room' => 'required',
            'start' => 'required|date_format:Y-m-d H:i|after:tomorrow',
            'end' => 'required|date_format:Y-m-d H:i|after:start',
            'description' => 'required'
        ];

        if ($this->request->get('type') == 'workshop')
        {
            $end_point['cost'] = 'required|numeric|min:0|max:1000000000';
        }


        return $end_point;
    }
}
