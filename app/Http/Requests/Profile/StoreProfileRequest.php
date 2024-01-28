<?php

namespace App\Http\Requests\Profile;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class StoreProfileRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'dni_number' => 'required|string|min:10|max:15',
            'phone_user' => 'nullable|string|max:20',
            'tel_user' => 'required|string|max:11',
            'address' => 'required|string',
            'birthday' => 'required|date',
            'gender' => 'required',
            'job_title' => 'required|string',
            'tel_job' => 'nullable|string|max:20',
            'user_id' => 'exists:users,id|unique:profiles,user_id',
            'is_passport' =>'boolean',
            'areas_list' => 'required|array|min:1',

        ];
    }

    public function messages()
    {
        return [
            'gender.required' => 'El campo género es obligatorio.',

        ];
    }

}
