<?php

namespace App\Http\Requests\Auth;
use App\Rules\ExistingUser;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'user_credential' => ['required','string','min:3','max:80', new ExistingUser],
            'password' => 'required',
            'remember'=> 'boolean'
        ];
    }
}
