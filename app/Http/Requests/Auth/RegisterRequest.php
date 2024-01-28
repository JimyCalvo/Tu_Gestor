<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class RegisterRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }
    protected function prepareForValidation()
    {
        $this->merge([
            'full_name' => ucwords(strtolower($this->name)).' '.ucwords(strtolower($this->last_name))
        ]);
    }


    public function rules(): array
    {
        return [
            'username' => ['required', 'string', 'max:40','unique:users,username'],
            'name' => ['required', 'string', 'max:40'],
            'last_name' => ['required', 'string', 'max:40'],
            'email' => ['required','string','email:rfc,dns','max:80','unique:users,email'],
            'password' => ['required', 'string','min:8', 'confirmed'],
            'full_name'=>'required',
        ];


    }



}
