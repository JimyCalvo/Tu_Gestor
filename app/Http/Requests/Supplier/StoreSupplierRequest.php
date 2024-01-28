<?php
namespace App\Http\Requests\Supplier;

use Illuminate\Foundation\Http\FormRequest;

class StoreSupplierRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name_supplier' => 'required',
            'contact_name' => 'nullable',
            'phone_supplier' => 'nullable|max:20',
            'tel_supplier' => 'nullable|max:10',
            'address_supplier' => 'nullable',
        ];
    }
}
