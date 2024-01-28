<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserInfoRequest extends FormRequest
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
        return [
            'name' => 'sometimes|required|string|max:40|min:3',
            'last_name' => 'sometimes|required|string|max:40|min:3',
            'username' => 'sometimes|required|string|max:255|unique:users,username,' . $this->user->id,
            'email' => 'sometimes|required|email:rfc,dns|max:255|unique:users,email,' . $this->user->id,
            'password' => 'sometimes|string|min:8',
            'full_name' => 'sometimes',

            'profile.dni_number' => 'required|string|max:13|min:10',
            'profile.passport' => 'sometimes|required_without:profile.is_passport|string|min:10|max:15',
            'profile.phone_user' => 'sometimes|required|string|max:20|min:7',
            'profile.address' => 'sometimes|required|string|max:255',
            'profile.tel_user' => 'sometimes|required|string|max:255',
            'profile.gender' => 'sometimes|required|in:male,female,other',
            'profile.birthday' => 'sometimes|required|date',
            'profile.tel_job' => 'sometimes|string|max:20|min:7',
            'profile.is_passport' => 'boolean',
            'areas_list' => 'required|array|min:1',
        ];
    }
}
