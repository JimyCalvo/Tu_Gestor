<?php
namespace App\Http\Requests\ItemData;

use Illuminate\Foundation\Http\FormRequest;

class StoreItemDataRequest extends FormRequest
{
    public function authorize()
    {
        return true; // Ajusta según la lógica de autorización
    }

    public function rules()
    {
        return [
            'name_item' => 'required|max:50',
            'quantity' => 'nullable|integer',
            'unity_cost' => 'required|numeric',
            'model' => 'nullable|max:255',
            'version' => 'nullable|max:255',
            'dimension' => 'nullable|max:50',
            'weight' => 'nullable|numeric',
            'color' => 'nullable|max:50',
            'items_price' => 'nullable|numeric',
            'description' => 'nullable',
            'manufacturer_id' => 'nullable|exists:manufacturers,id',
            'category_id' => 'required|exists:categories,id',
        ];
    }
}
