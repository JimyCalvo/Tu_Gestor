<?php

namespace App\Http\Requests\Item;

use Illuminate\Foundation\Http\FormRequest;

class StoreItemRequest extends FormRequest
{
    public function authorize()
    {
        return true; // Ajusta esto según tus requisitos de autorización
    }

    public function rules()
    {
        return [
            'status' => 'required|string',
            'supplier_id' => 'required|exists:suppliers,id',
            'comment' => 'required|string',
            'unique_code' => 'nullable|string',
            'inventory_id' => 'required|exists:inventories,id',
            'custody_id' => 'nullable|exists:users,id',
            'item_data_id' => 'required|exists:items_data,id',
        ];
    }
}
