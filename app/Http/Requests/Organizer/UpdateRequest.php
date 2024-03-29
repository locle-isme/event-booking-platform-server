<?php

namespace App\Http\Requests\Organizer;

use Illuminate\Validation\Rule;

class UpdateRequest extends StoreRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $rules = $this->getValidateRules();
        $rules['slug'] = [
            'required',
            'max:255',
            'regex:/^[a-zA-Z0-9-]+$/',
            Rule::unique('organizers')->ignore($this->route('organizer')->getAttribute('id'), 'id'),
        ];
        unset($rules['email']);
        if (empty($this->input('password'))) {
            unset($rules['password']);
        }
        return $rules;
    }

    public function messages()
    {
        return [
            'slug.regex' => "Slug must not be empty and only contain a-z, 0-9 and '-'",
            'slug.unique' => 'Slug is already used'
        ];
    }
}
