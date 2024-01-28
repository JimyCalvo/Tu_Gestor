<?php
namespace App\Http\Requests\Repository;

use Illuminate\Foundation\Http\FormRequest;

class StoreRepositoryRequest extends FormRequest
{
    public function authorize()
    {
        return true; // Cambiar según la lógica de autorización
    }

    public function rules()
    {
        return [
            'name_repository'=> 'required|string',
            'area_id' => 'required|exists:areas,id',
            'guardian_id' => 'nullable|exists:users,id',
        ];
    }
}
