<?php

namespace App\Http\Requests\ItemHistory;

use Illuminate\Foundation\Http\FormRequest;

class StoreItemHistoryRequest extends FormRequest
{
    public function authorize()
    {
        return true; // Ajusta según la lógica de autorización
    }

    public function rules()
    {
        return [
            'item_id' => 'required|exists:items,id',
            'responsible_id' => 'nullable|exists:users,id',

            'custody_id' => 'nullable|exists:users,id',

        ];
    }
}
