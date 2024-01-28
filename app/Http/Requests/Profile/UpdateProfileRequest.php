<?php

namespace App\Http\Requests\Profile;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateProfileRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }


    public function rules(): array
    {
        return [
            'dni' => 'nullable|string|unique:profiles,dni,' . $this->profile->id,
            'passport' => 'nullable|string|unique:profiles,passport,' . $this->profile->id,
            'phone_user' => 'string|max:20',
            'tel_user' => 'required|string|max:11',
            'address' => 'required|string',
            'birthday' => 'required|date',
            'gender' => 'required|string',
            'job_title' => 'required|string',
            'tel_job' => 'nullable|string|max:20',
            'user_id' => 'required|exists:users,id',
        ];
    }
}
