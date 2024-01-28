<?php
namespace App\Http\Requests\Repository;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRepositoryRequest extends FormRequest
{
    public function authorize()
    {
        return true; // Cambiar según la lógica de autorización
    }

    public function rules()
    {
        return [
            'quantity' => 'required|integer',
            'repository_cost' => 'nullable|numeric',
            'area_id' => 'nullable|exists:areas,id',
            'guardian_id' => 'nullable|exists:users,id',
        ];
    }
}
