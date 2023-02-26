<?php

namespace App\Http\Requests\Organizer;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return $this->getValidateRules();
    }

    protected function getValidateRules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:organizers',
            'password' => 'required|string|min:6|confirmed',
            'active' => 'nullable|in:0,1',
        ];
    }
}
