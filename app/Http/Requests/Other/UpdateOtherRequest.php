<?php

namespace App\Http\Requests\Other;

use Illuminate\Foundation\Http\FormRequest;

class UpdateOtherRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'tag' => 'required|string',
            'value' => 'required|string',
            'description' => 'nullable|integer',
            'item_id' => 'required|integer',
            'visible'=> 'boolean',

        ];
    }
}
