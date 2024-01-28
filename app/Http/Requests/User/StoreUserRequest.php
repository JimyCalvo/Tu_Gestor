<?php

namespace App\Http\Requests\User;


use Illuminate\Foundation\Http\FormRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class StoreUserRequest extends FormRequest
{


    public function authorize(): bool
    {
        return true;
    }
    protected function prepareForValidation()
    {
        $this->merge([
            'full_name' => ucwords(strtolower($this->name)) . ' ' . ucwords(strtolower($this->last_name))
        ]);
    }

    public function rules(): array
    {
        $user = auth()->user();
        $allowedRoles = [];

        switch ($user->role_id) {
            case 2:
                $allowedRoles = [1];
                break;
            case 3:
                $allowedRoles = [1, 2];
                break;
            case 4:
                $allowedRoles = [1, 2, 3];
                break;
        }
        return [
            'username' => ['required', 'string', 'max:40', 'unique:users,username'],
            'name' => ['required_with:name','required', 'string', 'max:40','min:3'],
            'last_name' => ['required_with:last_name','required', 'string', 'max:40','min:3'],
            'email' => ['required', 'string', 'email', 'max:80', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8'],
            'full_name' => 'required',
            'role_id' => ['required', Rule::in($allowedRoles)],
        ];
    }

}



