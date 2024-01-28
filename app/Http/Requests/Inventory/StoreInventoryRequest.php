<?php
namespace App\Http\Requests\Inventory;

use Illuminate\Foundation\Http\FormRequest;

class StoreInventoryRequest extends FormRequest
{
    public function authorize()
    {
        return true; // Cambiar según las políticas de autorización de tu aplicación
    }

    public function rules()
    {
        return [

            'repository_id' => 'required|exists:repositories,id',
            'responsible_id' => 'nullable|exists:users,id',
        ];
    }
}
