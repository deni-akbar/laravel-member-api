<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class UserUpdateRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $userId = $this->route('id');

        return [
            'name'     => 'required|string|max:255',
            'email'    => "required|email|unique:users,email,{$userId}",
            'password' => 'nullable|min:6',
            'hobbies'  => 'array',
            'hobbies.*' => 'string|max:100'
        ];
    }
}
