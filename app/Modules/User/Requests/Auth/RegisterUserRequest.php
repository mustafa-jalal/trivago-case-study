<?php

namespace App\Modules\User\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class RegisterUserRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    final public function rules(): array
    {
        return [
            'name' => 'required|min:3|max:32',
            'email' => ['required', 'email', 'unique:users'],
            'password' => 'required|min:8'
        ];
    }
}
