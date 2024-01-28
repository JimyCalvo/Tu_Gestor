<?php
namespace App\Http\Requests\Manufacturer;

use Illuminate\Foundation\Http\FormRequest;

class UpdateManufacturerRequest extends FormRequest
{
    public function authorize()
    {
        return true; // Cambiar según la lógica de autorización
    }

    public function rules()
    {
        return [
            'name' => 'required|max:255',
            'description' => 'nullable',
        ];
    }
}
