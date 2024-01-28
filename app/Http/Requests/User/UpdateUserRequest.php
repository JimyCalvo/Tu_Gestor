<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Models\User;

class UpdateUserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation()
    {

        if (!is_null($this->name) && !is_null($this->last_name)) {
            $this->merge([
                'full_name' => ucwords(strtolower($this->name)) . ' ' . ucwords(strtolower($this->last_name))
            ]);
        }
    }
    public function rules(): array
    {
        $userId = $this->route('user');

        $userAuth = auth()->user();
        $allowedRoles = [];

        switch ($userAuth->role_id) {
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
            'username' => ['sometimes','required', 'alpha_num:ascii', 'max:40', Rule::unique('users')->ignore($userId),],
            'email' => ['sometimes','required', 'email', 'max:80', Rule::unique('users')->ignore($userId),],
            'name' => ['sometimes','required_with:last_name','required', 'string', 'max:40','min:3'],
            'last_name' => ['sometimes','required_with:name','required', 'string', 'max:40', 'min:3'],
            'password' => ['sometimes','required', 'string', 'min:8'],
            'full_name' => 'sometimes',
            'role_id' => ['sometimes', Rule::in($allowedRoles)],
        ];
    }
}
