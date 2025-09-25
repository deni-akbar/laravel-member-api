<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserWebUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name'      => 'required|string|max:100',
            'email'    => [
                'required',
                'email',
                Rule::unique('users')->ignore($this->route('user'))
            ],
            'hobbies'   => 'array',
            'hobbies.*' => 'nullable|string|max:100'
        ];
    }
}
