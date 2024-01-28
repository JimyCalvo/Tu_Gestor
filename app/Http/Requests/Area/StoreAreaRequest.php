<?php

namespace App\Http\Requests\Area;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\ValidAddress;


class StoreAreaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name_area' => 'required|max:50|min:3',
            'address_area' =>  ['required','string'],
        ];
    }

}
